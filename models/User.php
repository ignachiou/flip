<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    
    public $id;
    public $usuario;
    public $email;
    public $clave;
    public $authKey;
    public $accessToken;
    public $activate;
    public $rol;

    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $id */
    
    public static function isUserAdmin($id)
    {
    	if (Usuarios::findOne(['id' => $id, 'activate' => '1', 'rol' => 3])){
    		return true;
    	} else {
    
    		return false;
    	}
    
    }
    
    public static function isUserCatalog($id)
    {
    	if (Usuarios::findOne(['id' => $id, 'activate' => '1', 'rol' => 2])){
    		return true;
    	} else {
    
    		return false;
    	}
    
    }
    
    public static function isUserSimple($id)
    {
    	if (Usuarios::findOne(['id' => $id, 'activate' => '1', 'rol' => 1])){
    		return true;
    	} else {
    
    		return false;
    	}
    }

    public static function findIdentity($id)
    {
        
        $user = Usuarios::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("id=:id", ["id" => $id])
                ->one();
        
        return isset($user) ? new static($user) : null;
    }

    /**
     * @inheritdoc
     */
    
    /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = Usuarios::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    /* Busca la identidad del usuario a través del username */
    public static function findByUsername($username)
    {
        $users = Usuarios::find()
                ->where("activate=:activate", ["activate" => 1])
                ->andWhere("usuario=:usuario", [":usuario" => $username])
                ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->usuario, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa la clave de autenticación */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    
    /* Valida la clave de autenticación */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        /* Valida el password */
        if (crypt($password, $this->clave) == $this->clave)
        {
        return $password === $password;
        }
    }
}