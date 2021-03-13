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

    protected function success($request, $view = "/")
	{
        if ($request->is("api/*")) {
            return response()->noContent();
        } else {
            toastr()->success('Saved successfully!');

            return redirect()
                ->route($view)
                ->withSuccess(__("actions.success"));
        }

	}

	protected function error($request, string $message = null, int $code, $data = null)
	{
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
