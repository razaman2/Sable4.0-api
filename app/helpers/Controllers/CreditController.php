<?php
    namespace Helpers\Controllers;

    use App\Http\Controllers\Controller;
    use Helpers\Credit\CreditData;
    use Helpers\Credit\CreditFactory;
    use Helpers\Credit\PullNew;
    use Helpers\Credit\PullPrevious;
    use Illuminate\Http\Request;

    class CreditController extends Controller
    {
        public function pullNew(Request $request) {
            $credit = new PullNew($request->all());

            $operation = CreditFactory::find($credit);

            dump($operation);
            dump($operation->execute());

            return response()->json($credit->getData());
        }

        public function pullPrevious(Request $request) {
            $credit = new PullPrevious($request->all());

            $operation = CreditFactory::find($credit);

            dump($operation);
            dump($operation->execute());

            return response()->json($credit->getData());
        }
    }
