# api-document-manager-ws
It was created two api-endpoints to proccedd with part of the assingment:
"/api/new-document-type" and "/api/new-document"

For "/api/new-document-type" here some important infos about settings:
- it is not necessary set any Query Paramether
- Authorization type is "No Auth"
- No aditional header is necessary
- At the body request is necessary to choose "form-data" and add two parameters:
    - "name" (text)
    - "type" (text)

For "/api/new-upload" here some important infos about settings:
- it is not necessary set any Query Paramether
- Authorization type is "No Auth"
- No aditional header is necessary
- At the body request is necessary to choose "form-data" and add two parameters:
    - "file" (type 'file' selected); The value should be a file to be uploaded
    - "name" (text); The value could be anything except for empty
    - "document_type" (text); The value should have the name of a document_type registered in the DB;
