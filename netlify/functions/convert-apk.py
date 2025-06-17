import json
import os
import zipfile
import io
import requests # Новая библиотека для скачивания файлов

# URL вашего template.apk на Netlify
# Убедитесь, что этот URL правильный и ваш template.apk публично доступен!
TEMPLATE_APK_URL = "https://zestudio.netlify.app/template.apk"
TARGET_ZIP_PATH_INSIDE_APK = 'assets/project.zip' # Путь к файлу внутри APK, который нужно заменить

def handler(event, context):
    try:
        print("DEBUG: Function started.")

        # Проверяем, что запрос содержит закодированные данные (для multipart/form-data)
        if not event.get('isBase64Encoded', False):
            print("ERROR: Request is not Base64 encoded.")
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'Expected base64 encoded multipart/form-data. Ensure your client sends binary data correctly.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        uploaded_file_data = None
        if 'newtrobat_file' in event:
            uploaded_file_data = event['newtrobat_file']
        elif event.get('body') and isinstance(event['body'], dict) and 'newtrobat_file' in event['body']:
            uploaded_file_data = event['body']['newtrobat_file']

        if not uploaded_file_data or not isinstance(uploaded_file_data, dict) or 'content' not in uploaded_file_data:
            print("ERROR: No newtrobat_file content found in request.")
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'No .newtrobat file found in the request. Make sure the input field name is "newtrobat_file" and file is selected.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        newtrobat_content = uploaded_file_data['content']
        print(f"DEBUG: Received newtrobat file with {len(newtrobat_content)} bytes.")

        # --- Шаг 1: Скачиваем template.apk с вашего сайта ---
        print(f"DEBUG: Attempting to download template.apk from {TEMPLATE_APK_URL}")
        try:
            response = requests.get(TEMPLATE_APK_URL, stream=True)
            response.raise_for_status() # Вызовет исключение для ошибок HTTP (4xx или 5xx)
            template_apk_bytes = response.content
            print(f"DEBUG: Successfully downloaded template.apk ({len(template_apk_bytes)} bytes).")
        except requests.exceptions.RequestException as e:
            print(f"ERROR: Failed to download template.apk: {e}")
            return {
                'statusCode': 500,
                'body': json.dumps({'error': f'Failed to download template APK from server: {str(e)}. Check URL and file availability.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        # --- Шаг 2: Модифицируем APK в памяти ---
        apk_stream_in = io.BytesIO(template_apk_bytes)
        apk_stream_out = io.BytesIO()

        try:
            with zipfile.ZipFile(apk_stream_in, 'r') as zip_read:
                with zipfile.ZipFile(apk_stream_out, 'w', zipfile.ZIP_DEFLATED) as zip_write:
                    for item in zip_read.infolist():
                        # Копируем все файлы, кроме того, который будем заменять
                        if item.filename != TARGET_ZIP_PATH_INSIDE_APK:
                            zip_write.writestr(item, zip_read.read(item.filename))
                        else:
                            print(f"DEBUG: Found existing {item.filename}, will replace.")

                    # Добавляем наш newtrobat файл, переименованный в project.zip
                    zip_write.writestr(TARGET_ZIP_PATH_INSIDE_APK, newtrobat_content)
                    print(f"DEBUG: Added new {TARGET_ZIP_PATH_INSIDE_APK} from uploaded .newtrobat.")

        except zipfile.BadZipFile:
            print(f"ERROR: Downloaded template.apk is not a valid ZIP file.")
            return {
                'statusCode': 400,
                'body': json.dumps({'error': 'Downloaded template APK is corrupted or not a valid ZIP file.'}),
                'headers': {'Content-Type': 'application/json'}
            }
        except Exception as e:
            print(f"ERROR: Failed to process APK internally: {str(e)}")
            return {
                'statusCode': 500,
                'body': json.dumps({'error': f'Internal processing error during APK modification: {str(e)}. Check function logs for details.'}),
                'headers': {'Content-Type': 'application/json'}
            }

        modified_apk_bytes = apk_stream_out.getvalue()
        print(f"DEBUG: Modified APK created with {len(modified_apk_bytes)} bytes.")

        # --- Шаг 3: Отправляем измененный APK обратно пользователю ---
        return {
            'statusCode': 200,
            'headers': {
                'Content-Type': 'application/vnd.android.package-archive',
                'Content-Disposition': 'attachment; filename="converted_app.apk"',
            },
            'body': modified_apk_bytes.decode('latin-1'),
            'isBase64Encoded': True
        }

    except Exception as e:
        print(f"FATAL ERROR: Unhandled exception: {str(e)}")
        return {
            'statusCode': 500,
            'body': json.dumps({'error': f'Unhandled server error: {str(e)}'}),
            'headers': {'Content-Type': 'application/json'}
        }
