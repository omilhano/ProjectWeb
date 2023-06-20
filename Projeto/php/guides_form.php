<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/guides_form.css"> -->
    <style>
        body {
            background: lightblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form_container {
            border: 2px solid #ccc;
            margin: auto;
            padding: 20px;
            background-color: white;
        }

        input[type="text"]:not([name="image"]):not([type="file"]),
        input[type="date"]:not([name="image"]):not([type="file"]),
        input[type="number"]:not([name="image"]):not([type="file"]) {
            border: none;
            border-bottom: 1px solid black;
            padding: 5px;
            width: 33%;
        }
    </style>
</head>

<body>
    <div class="form_container">
        <form action="guides_submit.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

            <p>
                <label for="username">Username</label>
                <input type="text" name="username" required>
            </p>
            <p>
                <label for="date">Date</label>
                <input type="date" name="date" required>
            </p>
            <p>
                <label for="country">Title</label>
                <input type="text" name="country" placeholder="Country(s)" required>
            </p>
            <p>
                <label for="location">Subtitle</label>
                <input type="text" name="location" placeholder="Specific Location(s)" required>
            </p>
            <p>
                <label style="position: relative; bottom: 50px" for="content">Description</label>
                <textarea style="width: 33%; height: 100px; resize: vertical; padding: 10px;" type="text" name="content"
                    maxlength="400" required></textarea>
            </p>
            <p>
                <label for="days">Nº of Days</label>
                <input type="number" name="days" required>
            </p>
            <p>
                <label for="km">Nº of Kilometers</label>
                <input type="number" name="km" required>
            </p>
            <p>
                <label for="cities">Nº of Cities</label>
                <input type="number" name="cities" required>
            </p>
            <p>
                <label for="image">Select Image File:</label>
                <input type="file" name="image" required>
            </p>

            <h3>Map Section:</h3>

            <p>
                <label for="startpoint">Start Point:</label>
                <input type="text" name="startpoint" placeholder="First Destination" required>
            </p>
            <p>
                <label for="waypoint">Way Point:</label>
                <input type="text" name="waypoint" placeholder="Mid Destination">
            </p>
            <p>
                <label for="endpoint">End Point:</label>
                <input type="text" name="endpoint" placeholder="Last Destination" required>
            </p>
            <p>
                <input type="submit" name="submit" value="submit guide">
            </p>
        </form>
    </div>
</body>

</html>