<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lead</title>
</head>
<body>
    <h1>Lead Data</h1>


    <form id="editForm" method="POST" action="{{ route('updateLead', ['id' => $leadId]) }}">
        @csrf
        <div id="fieldsContainer">
            <!-- Lead data fields will be populated here -->
        </div>
        <button type="submit">Update</button>
    </form>

    <script>
        window.onload = function() {
            // Populate lead data fields for editing
            var leadData = {!! json_encode($leadData) !!};
            var fieldsContainer = document.getElementById('fieldsContainer');
            for (var key in leadData) {
                var inputField = document.createElement('input');
                inputField.setAttribute('type', 'text');
                inputField.setAttribute('name', key);
                inputField.setAttribute('value', leadData[key]);
                fieldsContainer.appendChild(inputField);
            }
        };
    </script>
</body>
</html>
