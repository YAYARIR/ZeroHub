import json
import os
import zipfile
import io
import shutil # Для работы с временными файлами

# Определяем путь к нашему шаблонному APK
# __file__ - это путь к текущему файлу Python
# os.path.dirname(__file__) - это директория, в которой находится текущий файл
TEMPLATE_APK_PATH = os.path.join(os.path.dirname(__file__), 'template.apk')
TARGET_ZIP_PATH_INSIDE_APK = 'assets/project.zip' # Путь к файлу внутри APK, который нужно заменить

def handler(event, context):
    try:
        # Netlify Functions получают multipart/form-data в виде base64 закодированного тела
        # и metadata в event.body. event['files'] содержит разобранные файлы

        uploaded_file_data = None
        if 'newtrobat_file' in event:
            # Предполагаем, что поле формы называется 'newtrobat_file'
            uploaded_file_data = event['newtrobat_file']
        elif 'body' in event and isinstance(event['body'], dict) and 'newtrobat_file' in event['body']:
            # Иногда файл может быть прямо в body, как dict (редко)
            uploaded_file_data = event['body']['newtrobat_file']

        if not uploaded_file_data or not isinstance(uploaded_file_data, dict) or 'content' not in uploaded_file_data:
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'No newtrobat file found in the request. Make sure the input field name is "newtrobat_file".'}),
                'headers': {'Content-Type': 'application/json'}
            }

        newtrobat_content = uploaded_file_data['content']

        if not os.path.exists(TEMPLATE_APK_PATH):
            return {
                'statusCode': 500,
                'body': json.dumps({'error': f'Server configuration error: template.apk not found at {TEMPLATE_APK_PATH}'}),
                'headers': {'Content-Type': 'application/json'}
            }

        # Читаем шаблонный APK в память
        with open(TEMPLATE_APK_PATH, 'rb') as f:
            template_apk_bytes = f.read()

        # Создаем временный байтовый поток для работы с APK как с ZIP
        apk_stream_in = io.BytesIO(template_apk_bytes)
        apk_stream_out = io.BytesIO()

        try:
            with zipfile.ZipFile(apk_stream_in, 'r') as zip_read:
                with zipfile.ZipFile(apk_stream_out, 'w', zipfile.ZIP_DEFLATED) as zip_write:
                    for item in zip_read.infolist():
                        # Копируем все файлы, кроме того, который мы хотим заменить
                        if item.filename != TARGET_ZIP_PATH_INSIDE_APK:
                            zip_write.writestr(item, zip_read.read(item.filename))
                        else:
                            print(f"Found and will replace: {item.filename}")

                    # Добавляем наш newtrobat файл, переименованный в project.zip
                    zip_write.writestr(TARGET_ZIP_PATH_INSIDE_APK, newtrobat_content)
                    print(f"Added new {TARGET_ZIP_PATH_INSIDE_APK}")

        except zipfile.BadZipFile:
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'Template APK is not a valid ZIP file.'}),
                'headers': {'Content-Type': 'application/json'}
            }
        except Exception as e:
            return {
                'statusCode': 500,
                'body': json.dumps({'error': f'Failed to process APK internally: {str(e)}'}),
                'headers': {'Content-Type': 'application/json'}
            }

        # Получаем байты измененного APK
        modified_apk_bytes = apk_stream_out.getvalue()

        # Отправляем измененный APK обратно пользователю
        return {
            'statusCode': 200,
            'headers': {
                'Content-Type': 'application/vnd.android.package-archive', # MIME тип для APK
                'Content-Disposition': 'attachment; filename="modified_app.apk"', # Имя файла для скачивания
            },
            'body': modified_apk_bytes.decode('latin-1'), # Отправляем байты, закодированные в latin-1 (Netlify требует строки для base64)
            'isBase64Encoded': True # Указываем Netlify, что тело закодировано в base64
        }

    except Exception as e:
        # Общий обработчик ошибок
        return {
            'statusCode': 500,
            'body': json.dumps({'error': f'Server error: {str(e)}'}),
            'headers': {'Content-Type': 'application/json'}
        }
