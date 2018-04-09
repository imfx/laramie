<?php

namespace Laramie\Admin\Http\Controllers;

use App\Models\User;
use Laramie\Admin\Http\Requests\UserRequest;
use Laramie\Admin\Repositories\UserRepository;
use Laramie\Admin\Facades\Admin;
use Laramie\Admin\Layout\Content;
use Laramie\Admin\Layout\Table;
use Laramie\Admin\Layout\Detail;

class UsersController extends BaseResourceController
{
	protected $label = 'Usuarios';

	protected $indexView = 'admin::users/index';
	protected $showView = 'admin::users/show';

	public function repository()
	{
		return UserRepository::class;
	}

	public function list($items)
	{
		return Admin::table(function (Table $table) use ($items) {
			$table->rows($items);

			$table->column('id', 'ID');
			$table->column('full_name', 'Nombre Completo')->linkable();
			$table->column('account_age', 'Creado');
			$table->column('last_modified', 'Modificado');
		});
	}

	public function detail($item)
	{
		return Admin::detail(function (Detail $detail) use ($item) {
            $detail->title('Detalle de Usuario');
            $detail->item($item);

			$detail->field('full_name', 'Nombre Completo');
			$detail->field('email', 'Email');
			$detail->field('account_age', 'Creado');
		});
	}

	public function form()
	{
	}

	public function create()
	{
        return Admin::content(function (Content $content) {
            $content->header('Añadir Usuarios');
            $content->description('Añadir Usuarios');
            $content->body($this->form());
        });
	}

	public function store()
	{
		$this->validate(request(), $this->rules());
	}

	public function rules()
	{
		return [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|unique:users|email|max:255',
			'password' => 'required',
		];
	}
}
