<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Lead</title>
</head>
<body>
    <form id="dynamicForm" method="POST" action="{{ route('storeLead') }}">
        @csrf
        <div id="fieldsContainer">

        </div>
        <button type="submit">Submit</button>
    </form>


    <input type="text" id="addField">

    <button id="addFieldButton">Add Field</button>

    <script>
        document.getElementById('addFieldButton').addEventListener('click', function() {
            var selectedField = document.getElementById('addField').value;
            var inputField = document.createElement('input');
            inputField.setAttribute('type', 'text');
            inputField.setAttribute('name', selectedField);
            inputField.setAttribute('placeholder', selectedField);
            document.getElementById('fieldsContainer').appendChild(inputField);
        });
    </script>
</body>
</html>
