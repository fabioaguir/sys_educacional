<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\PermissionRepository;
use SerEducacional\Repositories\RoleRepository;
use SerEducacional\Repositories\UserRepository;
use SerEducacional\Entities\User;

class UserService
{
    use TraitService;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * DisciplinaService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository,
                                RoleRepository $roleRepository,
                                PermissionRepository $permissionRepository)
    {
        $this->repository           = $repository;
        $this->roleRepository       = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function store(array $data) : User
    {
        #tratando a senha
        $data['password'] = bcrypt($data['password']);
        $data['active'] = 1;

        #tratando a imagem
//        if(isset($data['img'])) {
//            $file     = $data['img'];
//            $fileName = md5(uniqid(rand(), true)) . "." . $file->getClientOriginalExtension();
//
//            #Movendo a imagem
//            $file->move($this->destinationPath, $fileName);
//
//            #setando o nome da imagem no model
//            $data['path_image'] = $fileName;
//
//            #destruindo o img do array
//            unset($data['img']);
//        }

        #Salvando o registro pincipal
        $user =  User::create($data);

        #Verificando se foi criado no banco de dados
        if(!$user) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Recupernado as roles e permissions
        $roles       = $data['role'] ?? [];
        $permissions = $data['permission'] ?? [];

        #Tratando os papéis
        foreach ($roles as $role) {
            #Recuperando os papéis
            $roleObj = $this->roleRepository->find($role);

            #Verificando se o registro foi recuperado
            if(!$user) {
                throw new \Exception('Ocorreu um erro ao cadastrar os perfís!');
            }

            #Vinculando ao usuário
            $user->attachRole($roleObj);
        }

        #Tratando as permissões
        foreach ($permissions as $permission) {
            #Recuperando os papéis
            $permissionObj = $this->permissionRepository->find($permission);

            #Verificando se o registro foi recuperado
            if(!$permissionObj) {
                throw new \Exception('Ocorreu um erro ao cadastrar as permissões!');
            }

            #Vinculando ao usuário
            $user->attachPermission($permissionObj);
        }

        #Retorno
        return $user;
    }

    /**
     * @param array $data
     * @param int $id
     * @return User
     * @throws \Exception
     */
    public function update(array $data, int $id) : User
    {
        # Variável que armazenará a nova senha
        $newPassword = "";

        #tratando a senha
        if(empty($data['password'])) {
            unset($data['password']);
        } else {
            $newPassword = \bcrypt($data['password']);
        }

        #Salvando o registro pincipal
        $user =  $this->repository->update($data, $id);

        # Alterando a senha do usuário
        if($newPassword) {
            $user->fill([
                'password' => $newPassword
            ])->save();
        }

        #tratando a imagem
//        if(isset($data['img'])) {
//            $file     = $data['img'];
//            $fileName = md5(uniqid(rand(), true)) . "." . $file->getClientOriginalExtension();
//
//            #removendo a imagem antiga
//            if($user->path_image != null) {
//                unlink(__DIR__ . "/../../public/" . $this->destinationPath . $user->path_image);
//            }
//
//            #Movendo a imagem
//            $file->move($this->destinationPath, $fileName);
//
//            #setando o nome da imagem no model
//            $user->path_image = $fileName;
//            $user->save();
//
//            #destruindo o img do array
//            unset($data['img']);
//        }


        #Verificando se foi criado no banco de dados
        if(!$user) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #deletando as roles e permissions
        $user->detachAllPermissions();
        $user->detachAllRoles();

        #Recupernado as roles e permissions
        $roles       = $data['role'] ?? [];
        $permissions = $data['permission'] ?? [];

        #Tratando os papéis
        foreach ($roles as $role) {
            #Recuperando os papéis
            $roleObj = $this->roleRepository->find($role);

            #Verificando se o registro foi recuperado
            if(!$user) {
                throw new \Exception('Ocorreu um erro ao cadastrar os perfís!');
            }

            #Vinculando ao usuário
            $user->attachRole($roleObj);
        }

        #Tratando as permissões
        foreach ($permissions as $permission) {
            #Recuperando os papéis
            $permissionObj = $this->permissionRepository->find($permission);

            #Verificando se o registro foi recuperado
            if(!$permissionObj) {
                throw new \Exception('Ocorreu um erro ao cadastrar as permissões!');
            }

            #Vinculando ao usuário
            $user->attachPermission($permissionObj);
        }

        #Retorno
        return $user;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        #deletando o curso
        $result = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao tentar remover o curso!');
        }

        #retorno
        return true;
    }
}