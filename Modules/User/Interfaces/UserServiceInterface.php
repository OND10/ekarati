<?php

namespace Modules\User\Interfaces;
use Illuminate\Http\UploadedFile;

interface UserServiceInterface {
    public function getUserById($id);
    public function getUserByEmail($email);
    public function registerUser(array $data);
    public function login(array $data);
    public function forgotPassword(array $data);
    public function resetPassword(array $data);
    public function validateToken(string $token);
    public function updateUser($id, array $data);
    public function deleteUser($id);
    public function isRoleAllowed($userId, $allowedRole);
    public function generateTokens($user);
    public function refreshAccessToken($refreshToken);
    public function activateUser($userId);
    public function deactivateUser($userId);
    public function getUserProfile($user);
    public function updateProfile($user, array $data, ?UploadedFile $image = null);
}
