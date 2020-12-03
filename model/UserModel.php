<?php


class UserModel
{
    static function SignIn($con,$login,$password,$dataVueErreur):bool{
        $gtw = new GatewayUser($con);
        return $gtw->signIn($login,$password,$dataVueErreur);
    }
    static function SignUp($con,$login,$password,$dataVueErreur):bool{
        $gtw = new GatewayUser($con);
        return $gtw->signUp($login,$password,$dataVueErreur);
    }
}