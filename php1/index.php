<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo '<link rel="stylesheet" href="style.css">';?>
    <title>PHP Output 1</title>
    <style>
        body {
            font-family: "Arial";
        }
    </style>
</head>
<body>

<div class="container">
    <h1>PHP Output No. 1</h1>
    
    <fieldset>
        <legend>This form uses GET request</legend>
        <form action="redirect.php" method="GET">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" placeholder="Enter First Name" required />
                </td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td>
                    <input type="text" name="mname" placeholder="Enter Middle Name" required />
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" placeholder="Enter Last Name" required />
                </td>
            </tr>

            <tr>
                <td>Age</td>
                <td>
                    <input type="number" name="age" placeholder="Enter Age" required/>
                </td>
            </tr>

            <tr>
                <td>Gender</td>
                <td>
                    <input type="text" name="gender" placeholder="Enter Gender" required/>
                </td>
            </tr>

            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="email" placeholder="Enter Email" required/>
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" placeholder="Enter Address" required/>
                </td>
            </tr>

            <tr>
                <td>Contact_Number</td>
                <td>
                    <input type="number" name="contactnumber" placeholder="Enter Contact Number" required/>
                </td>
            </tr>


            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit Data">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
    </fieldset>
    
    <fieldset style="margin-top: 20px">
        <legend>This form uses POST request</legend>
        <form action="redirect.php" method="POST">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" placeholder="Enter First Name" required />
                </td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td>
                    <input type="text" name="mname" placeholder="Enter Middle Name" required />
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" placeholder="Enter Last Name" required />
                </td>
            </tr>

            <tr>
                <td>Age</td>
                <td>
                    <input type="number" name="age" placeholder="Enter Age" required/>
                </td>
            </tr>

            <tr>
                <td>Gender</td>
                <td>
                    <input type="text" name="gender" placeholder="Enter Gender" required/>
                </td>
            </tr>

            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="email" placeholder="Enter Email" required/>
                </td>
            </tr>

            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" placeholder="Enter Address" required/>
                </td>
            </tr>

            <tr>
                <td>Contact_Number</td>
                <td>
                    <input type="number" name="contactnumber" placeholder="Enter Contact Number" required/>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit Data">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
    </fieldset>
</div>
</body>
</html>