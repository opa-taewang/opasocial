<?php


namespace App\Exceptions;

class Handler extends \Illuminate\Foundation\Exceptions\Handler
{
    protected $dontReport = ["Illuminate\\Auth\\AuthenticationException", "Illuminate\\Auth\\Access\\AuthorizationException", "Symfony\\Component\\HttpKernel\\Exception\\HttpException", "Illuminate\\Database\\Eloquent\\ModelNotFoundException", "Illuminate\\Session\\TokenMismatchException", "Illuminate\\Validation\\ValidationException"];
    public function report(\Exception $exception)
    {
        parent::report($exception);
    }
    public function render($request, \Exception $exception)
    {
        if ($request->wantsJson()) {
            $response = ["success" => false, "data" => [], "errors" => ["Sorry, something went wrong."]];
            if (config("app.debug")) {
                $response["exception"] = get_class($exception);
                $response["message"] = $exception->getMessage();
                $response["trace"] = $exception->getTrace();
            }
            $status = 400;
            if ($this->isHttpException($exception)) {
                $status = $exception->getStatusCode();
            }
            return response()->json($response, $status);
        }
        return parent::render($request, $exception);
    }
    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(["error" => "Unauthenticated."], 401);
        }
        return redirect()->guest("login");
    }
}

?>