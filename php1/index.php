<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Output 1</title>
</head>
<body>

<div class="container">
    <h1>PHP Output No. 1</h1>

    <fieldset>
        <legend>This form uses GET request</legend>
        <form action="redirect.php" method="GET" onsubmit="return validateForm(this)">
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
                    <input type="text" name="mname" placeholder="Enter Middle Name" />
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
                    <input type="number" name="age" placeholder="Enter Age" min="1" max="120" required />
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="email" placeholder="Enter Email" required />
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" placeholder="Enter Address" required />
                </td>
            </tr>
            <tr>
                <td>Contact_Number</td>
                <td>
                    <input type="text" name="contactnumber" placeholder="Enter Contact Number" required />
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
        <form action="redirect.php" method="POST" onsubmit="return validateForm(this)">
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
                    <input type="text" name="mname" placeholder="Enter Middle Name" />
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
                    <input type="number" name="age" placeholder="Enter Age" min="1" max="120" required />
                </td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type="email" name="email" placeholder="Enter Email" required />
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <input type="text" name="address" placeholder="Enter Address" required />
                </td>
            </tr>
            <tr>
                <td>Contact_Number</td>
                <td>
                    <input type="text" name="contactnumber" placeholder="Enter Contact Number" required />
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

<style>
    .err { color: red; font-size: 12px; margin-left: 6px; }
</style>

<script>
    function validateForm(form) {
        var valid = true;
        var prefix = form.method === 'get' ? 'get' : 'post';

        var age = parseInt(form.age.value);
        if (isNaN(age) || age < 1 || age > 120) {
            alert('Enter a valid age (1-120).');
            valid = false;
        }

        if (form.gender.value === '') {
            alert('Please select a gender.');
            valid = false;
        }

        var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRe.test(form.email.value.trim())) {
            alert('Enter a valid email address.');
            valid = false;
        }

        if (form.address.value.trim().length < 5) {
            alert('Address must be at least 5 characters.');
            valid = false;
        }

        var phoneRe = /^(09|\+639)\d{9}$/;
        if (!phoneRe.test(form.contactnumber.value.trim())) {
            alert('Enter a valid PH number (e.g. 09171234567).');
            valid = false;
        }

        return valid;
    }
</script>

</body>
</html>