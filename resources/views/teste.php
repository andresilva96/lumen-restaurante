<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<form id="form">
    <input type="text" name="name" value="Erik's bar">
    <input type="text" name="description" value="Melhor Wiski da região">
    <input type="file" name="photo" id="file">
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">

    $('#file').on('change', function () {

        let formData = new FormData();
        formData.append('name', 'Teste Bar');
        formData.append('description', 'Melhor prato teste');
        formData.append('photo', $('#file')[0].files[0]);

        let headers = {
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXBpL3YxL2F1dGgvbG9naW4iLCJpYXQiOjE1MjM1ODE5OTAsImV4cCI6MTUyMzU4NTU5MCwibmJmIjoxNTIzNTgxOTkwLCJqdGkiOiJ4UUIzYlZHQWtUUkJNMHpBIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.6Jn2ujX8VTw0mt5QM3jlg5cR30F5DaEY-7loJOw7vEo',
            //'content-type': 'multipart/form-data'
            'content-type': 'application/x-www-form-urlencoded'
        }

        axios.post('http://localhost:8080/api/v1/restaurant/1', formData, {headers: headers})
    })
</script>
</body>
</html>