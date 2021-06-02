<?php
    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use Helpers\Text\Text;
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

        public function text(Request $request) {
            $response = (new Text($request->input('phone')))->send($request->input('message'));

            return response()->json($response);
        }
    }
