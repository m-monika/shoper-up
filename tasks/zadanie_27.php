<?php

function validateUserData(array $data): array {
	$error = [];
	
	//sprawdzanie dlugosci loginu
	if (strlen($data['username']) < 3) {
		$error[] = "Niepoprawne dane";
	}
	
	//sprawdzanie emalia
	if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
		$error[] = "Niepoprawne dane";
	}
	
	//sprawdzanie dlugości hasła
	if (strlen($data['password1']) < 10) {
		$error[] = "Niepoprawne dane";
	}
	
	//sprawdzanie czy obydwa hasła są takie same
	if ($data['password1'] !== $data['password2']) {
		$error[] = "Niepoprawne dane";
	}
	
	return $error;
}

function registrationNewUser(array $input): array {
	$normalized = [
		'username'  => trim($input['username'] ?? ''),
        'email'     => strtolower(trim($input['email'] ?? '')),
        'password1' => $input['password1'] ?? '',
        'password2' => $input['password2'] ?? ''
		];
		
	$validationErrors = validateUserData($normalized);
	
	if (empty($validationErrors)) {
        return [
            'status' => 'success',
            'user'   => [
                'username' => $normalized['username'],
                'email'    => $normalized['email']
            ]
        ];
    }
    
    return [
        'status' => 'error',
        'errors' => $validationErrors
    ];
}

$newUser = $params[0]; // tej linijki nie ruszamy :)

$result = registrationNewUser($newUser);

if ($result['status'] === 'success') {
	echo $newUser['username'] . ' (' . strtolower(trim($newUser['email'])) . ')' . ' został zarejestrowany';
} else {
	echo "Niepoprawne dane";
}