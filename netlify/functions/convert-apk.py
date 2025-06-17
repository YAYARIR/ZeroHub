import json
import os
import zipfile
import io
import shutil

# Определяем путь к нашему шаблонному APK
# __file__ - это путь к текущему файлу Python (convert_apk.py)
# os.path.dirname(__file__) - это директория, в которой находится текущий файл (netlify/functions)
TEMPLATE_APK_PATH = os.path.join(os.path.dirname(__file__), 'template.apk')
TARGET_ZIP_PATH_INSIDE_APK = 'assets/project.zip' # Путь к файлу внутри APK, который нужно заменить

def handler(event, context):
    try:
        # Проверяем, что запрос содержит закодированные данные (для multipart/form-data)
        if not event.get('isBase64Encoded', False):
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'Expected base64 encoded multipart/form-data. Ensure your client sends binary data correctly.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        # Netlify Functions автоматически разбирают multipart/form-data и помещают файлы в event['files']
        # Или в event[<имя_поля_формы>]['content'] в более новых версиях
        uploaded_file_data = None
        if 'newtrobat_file' in event:
            uploaded_file_data = event['newtrobat_file']
        elif event.get('body') and isinstance(event['body'], dict) and 'newtrobat_file' in event['body']:
            # Это резервный вариант, если uploaded_file_data не заполняется напрямую
            uploaded_file_data = event['body']['newtrobat_file']

        if not uploaded_file_data or not isinstance(uploaded_file_data, dict) or 'content' not in uploaded_file_data:
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'No newtrobat file found in the request. Make sure the input field name is "newtrobat_file" and file is selected.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        newtrobat_content = uploaded_file_data['content']

        # Проверяем, существует ли шаблон APK
        if not os.path.exists(TEMPLATE_APK_PATH):
            print(f"ERROR: template.apk not found at {TEMPLATE_APK_PATH}") # Логируем на стороне сервера
            return {
                'statusCode': 500,
                'body': json.dumps({'error': f'Server configuration error: template.apk not found. Please ensure it is deployed with the function.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        # Читаем шаблонный APK в память
        with open(TEMPLATE_APK_PATH, 'rb') as f:
            template_apk_bytes = f.read()

        # Создаем временные байтовые потоки для работы с APK как с ZIP
        apk_stream_in = io.BytesIO(template_apk_bytes)
        apk_stream_out = io.BytesIO()

        try:
            # Открываем шаблонный APK для чтения
            with zipfile.ZipFile(apk_stream_in, 'r') as zip_read:
                # Открываем новый ZIP-файл для записи (будущий APK)
                # Используем ZIP_DEFLATED для сжатия (стандартно для APK)
                with zipfile.ZipFile(apk_stream_out, 'w', zipfile.ZIP_DEFLATED) as zip_write:
                    for item in zip_read.infolist():
                        # Копируем все файлы из оригинального APK, кроме того, который будем заменять
                        if item.filename != TARGET_ZIP_PATH_INSIDE_APK:
                            # Важно: используем writestr для копирования содержимого файла,
                            # а не только имени. item.compress_type сохранит оригинальный тип сжатия.
                            zip_write.writestr(item, zip_read.read(item.filename))
                        else:
                            print(f"DEBUG: Found existing {item.filename}, will replace.")

                    # Добавляем загруженный newtrobat файл, переименованный в project.zip
                    zip_write.writestr(TARGET_ZIP_PATH_INSIDE_APK, newtrobat_content)
                    print(f"DEBUG: Added new {TARGET_ZIP_PATH_INSIDE_APK} from uploaded .newtrobat.")

        except zipfile.BadZipFile:
            print(f"ERROR: Uploaded template.apk is not a valid ZIP file.")
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'Server template APK is corrupted or not a valid ZIP file.'}),
                'headers': {'Content-Type': 'application/json'}
            }
        except Exception as e:
            print(f"ERROR: Failed to process APK internally: {str(e)}") # Логируем детальную ошибку на сервере
            return {
                'statusCode': 500,
                'body': json.dumps({'error': f'Internal processing error: {str(e)}. Check function logs for details.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        # Получаем байты измененного APK
        modified_apk_bytes = apk_stream_out.getvalue()

        # Отправляем измененный APK обратно пользователю
        return {
            'statusCode': 200,
            'headers': {
                'Content-Type': 'application/vnd.android.package-archive', # Стандартный MIME-тип для APK
                'Content-Disposition': 'attachment; filename="converted_app.apk"', # Имя файла для скачивания
            },
            'body': modified_apk_bytes.decode('latin-1'), # Netlify ожидает строку для base64 кодирования
            'isBase64Encoded': True # Указываем Netlify, что тело уже в base64 (на самом деле, latin-1 для Netlify)
        }

    except Exception as e:
        # Общий обработчик ошибок верхнего уровня
        print(f"FATAL ERROR: {str(e)}") # Логируем критическую ошибку
        return {
            'statusCode': 500,
            'body': json.dumps({'error': f'Unhandled server error: {str(e)}'}),
            'headers': {'Content-Type': 'application/json'}
        }
