<?php
    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use Helpers\Text\TextClient;
    use Illuminate\Http\Request;

    class TwilioController extends Controller
    {
        use TextClient;

        public function lookup(Request $request) {
            $response = $this->setup()->lookups->phoneNumbers($request->input('phone'))->fetch([
                "type" => "carrier",
            ])->carrier;

            return response()->json($response);
        }
    }
