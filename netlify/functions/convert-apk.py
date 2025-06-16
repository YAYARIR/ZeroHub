import json
import os
import zipfile
import io
import cgi # Для парсинга multipart/form-data

# Путь к базовому шаблону APK.
# В Netlify Functions файлы репозитория доступны в текущей рабочей директории функции.
# Ваш template.apk находится в корне репозитория (zerohub/template.apk)
TEMPLATE_APK_PATH = os.path.join(os.getcwd(), 'template.apk')

def handler(event, context):
    try:
        # 1. Парсинг входящих данных (multipart/form-data)
        # Netlify Functions передают body как строку Base64, если isBase64Encoded = True
        body = event['body']
        if event.get('isBase64Encoded'):
            import base64
            body = base64.b64decode(body)

        # Используем cgi для парсинга multipart/form-data
        # cgi.FieldStorage требует file-like object, поэтому используем io.BytesIO
        headers = {'content-type': event['headers'].get('content-type', 'application/octet-stream')}
        fs = cgi.FieldStorage(
            fp=io.BytesIO(body),
            headers=headers,
            environ={'REQUEST_METHOD': 'POST'} # Важно для cgi.FieldStorage
        )

        newtrobat_file_item = fs['newtrobatFile']

        if not newtrobat_file_item.filename:
            return {
                'statusCode': 400,
                'body': 'No file uploaded.'
            }

        original_filename = newtrobat_file_item.filename
        newtrobat_content = newtrobat_file_item.file.read()

        # 2. Подготовка пути для временных файлов
        # В Netlify Functions /tmp доступна для временных файлов
        # Однако, для нашей задачи, мы можем работать в памяти или с относительными путями,
        # так как template.apk доступен относительно текущей директории функции.

        # 3. Открытие template.apk (как ZIP)
        if not os.path.exists(TEMPLATE_APK_PATH):
             return {
                'statusCode': 500,
                'body': f"Template APK not found at {TEMPLATE_APK_PATH}"
            }

        # Открываем template.apk в памяти для модификации
        with open(TEMPLATE_APK_PATH, 'rb') as f:
            template_apk_data = io.BytesIO(f.read())

        # Создаем новый ZIP-файл (apk) в памяти
        output_apk_in_memory = io.BytesIO()
        with zipfile.ZipFile(template_apk_data, 'r') as old_apk_zip:
            with zipfile.ZipFile(output_apk_in_memory, 'w', zipfile.ZIP_DEFLATED) as new_apk_zip:
                # Копируем все файлы из старого APK, кроме project.zip
                for item in old_apk_zip.infolist():
                    if item.filename == 'project.zip':
                        continue # Пропускаем старый project.zip
                    new_apk_zip.writestr(item, old_apk_zip.read(item.filename))

                # Добавляем новый project.zip из newtrobat файла
                # newtrobat_content уже содержит данные файла
                new_apk_zip.writestr('project.zip', newtrobat_content)

        output_apk_in_memory.seek(0) # Переводим указатель в начало потока

        # 4. Формирование ответа
        # Имя файла для скачивания (Мини шутер 1-0.apk)
        base_name = os.path.splitext(original_filename)[0] # Имя без .newtrobat
        output_filename = f"{base_name}.apk"

        return {
            'statusCode': 200,
            'headers': {
                'Content-Type': 'application/vnd.android.package-archive', # MIME-тип для APK
                'Content-Disposition': f'attachment; filename="{output_filename}"'
            },
            'body': base64.b64encode(output_apk_in_memory.getvalue()).decode('utf-8'),
            'isBase64Encoded': True
        }

    except Exception as e:
        return {
            'statusCode': 500,
            'body': f"An error occurred: {str(e)}"
        }