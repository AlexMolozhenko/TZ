<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TZ</title>
    <link href="/App/Resources/css/main.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="main_block">
        <div>
            <form id="task_form">
                <fieldset>
                    <legend>Task</legend>
                    <input type="hidden" id="id" name="id" value="">
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" required><br><br>

                    <label for="description">Description:</label><br>
                    <textarea id="description" name="description" rows="4" required></textarea><br><br>
                    <div class="div_btn">
                        <button type="button" class="save_btn">Save</button>
                        <button  type="button" class="update_btn">Update</button>
                        <button  type="button" class="cancel_btn">Cancel</button>
                    </div>

                </fieldset>
            </form>
            <div class="div_load_task">
                <button type="button" class="load_task_btn">Load Task</button>
            </div>
        </div>

        <div>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="body_table_task"></tbody>
            </table>
        </div>

    </div>
    <script src="/App/Resources/js/main.js"></script>
</body>
</html>