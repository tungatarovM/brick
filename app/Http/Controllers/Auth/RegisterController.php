<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Entity\Account\Entities\User;
use App\Entity\Account\AccountService;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    use RegistersUsers;

    private $account;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     * @param AccountService $accountService
     * @return void
     */
    public function __construct(AccountService $accountService)
    {
        $this->middleware('guest');
        $this->account = $accountService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'organization' => ['required', 'string'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            $user = $this->account->register($request->all());
        } catch (\Throwable $e) {

            Log::channel('critical')
                ->critical($e->getMessage(), [
                    'error' => $e,
                ]);

            return $request->wantsJson()
                ? new JsonResponse(trans('error.auth.error'), Response::HTTP_INTERNAL_SERVER_ERROR)
                : redirect()->back()
                    ->with('error', trans('error.auth.error'))
                    ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        event(new Registered($user));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @throws \Throwable $e
     * @return User
     */
    protected function create(array $data): User
    {
        return $this->account->register($data);
    }
}
