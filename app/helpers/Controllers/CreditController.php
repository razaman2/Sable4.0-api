<?php
    namespace App\helpers\Controllers;

    use App\Http\Controllers\Controller;
    use Helpers\Credit\CreditData;
    use Helpers\Credit\CreditFactory;
    use Illuminate\Http\Request;

    class CreditController extends Controller
    {
        public function pullNew(Request $request) {
            $credit = new CreditData($request->all());

            $operation = CreditFactory::find($credit);

            return response()->json($operation->getScore());
        }

        public function pullPrevious() {

        }
    }
