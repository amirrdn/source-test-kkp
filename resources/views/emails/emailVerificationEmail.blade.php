<!DOCTYPE html>
<html lang="en">
    <body>
        <p>Dear {{ $user->name }}</p>
            <p>Your account has been created, your code OTP</p>
            <p>
                {{$user->otp}}
            </p>
        <p>Thanks</p>
    </body>
</html> 