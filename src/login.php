<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<div class="w-full max-w-xs mx-auto mt-32">
		<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="authentication.php">
			<div class="mb-4">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="username">
					Username
				</label>
				<input
					class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
					id="username" name="username" type="text" placeholder="Username">
			</div>
			<div class="mb-6">
				<label class="block text-gray-700 text-sm font-bold mb-2" for="password">
					Password
				</label>
				<input
					class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
					id="password" name="password" type="password" placeholder="******">
			</div>
			<div class="flex items-center justify-between">
				<input
					class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
					type="submit" value="Sign In">
				<a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="https://youtu.be/pEg_d2f6myw">
					Forgot Password?
				</a>
			</div>
		</form>
		<p class="text-center text-gray-500 text-xs">
			&copy;2023 Feng Chia University. All rights reserved.
		</p>
	</div>

</body>

</html>