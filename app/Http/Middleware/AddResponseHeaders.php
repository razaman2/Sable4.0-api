<?php
    namespace App\Http\Middleware;

    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class AddResponseHeaders
    {
        public function handle($request, Closure $next) {
            // Handle the request
            $response = $next($request);

            return $this->addHeaders($request, $response);
        }

        protected function addHeaders(Request $request, Response $response) : Response {
            $response->headers->add([
                'Content-Security-Policy' => 'upgrade-insecure-requests',
            ]);

            return $response;
        }
    }
