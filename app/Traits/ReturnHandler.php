<?php

namespace App\Traits;

/*
|--------------------------------------------------------------------------
| Return Handler Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ReturnHandler
{

	protected function loaded($request, $data, int $code = 200, $view = "/")
	{
        if ($request->is("api/*")) {
            return response()->json($data, $code);
        } else {
            return view($view, $data);
        }

	}

    protected function success($request, $view = "/", $data = null)
	{
        if ($request->is("api/*")) {
            return response()->noContent();
        } else {
            toastr()->success('Saved successfully!');

            if ($data) {
                return redirect()
                    ->route($view, $data)
                    ->withSuccess(__("actions.success"));
            } else {
                return redirect()
                    ->route($view)
                    ->withSuccess(__("actions.success"));
            }

        }

	}

	protected function error($request, string $message = null, int $code, $data = null)
	{
        if ($code == 0) {
            $code = 500;
        }
        if ($request->is("api/*")) {
            return response()->json([
                'status' => 'Error',
                'message' => $message,
                'data' => $data
            ], $code);
        } else {
            toastr()->error('An error has occurred please try again later.');
            return back()->with("error", $message);
        }

	}

}
