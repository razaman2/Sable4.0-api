<?php
    namespace Helpers\Controllers;

    use App\helpers\Credit\CreditTest;
    use App\Http\Controllers\Controller;
    use Helpers\Credit\CreditFactory;
    use Helpers\Credit\PullNew;
    use Helpers\Credit\PullPrevious;
    use Illuminate\Http\Request;

    class CreditController extends Controller
    {
        public function pullNew(Request $request) {
            if($request->input('test')) {
                return response()->json((new CreditTest())->execute($request->all()));
            }

            $credit = new PullNew($request->all());

            $operation = CreditFactory::find($credit);

            return response()->json($operation->execute()->getScore());
        }

        public function pullPrevious(Request $request) {
            $credit = new PullPrevious($request->all());

            $operation = CreditFactory::find($credit);

            if($credit->getType() === 'score') {
                return response()->json($operation->execute()->getScore());
            } elseif($credit->getType() === 'tty') {
                return response()->json($operation->execute()->getTty());
            } elseif($credit->getType() === 'html') {
                return response()->json($operation->execute()->getHtml());
            }
        }
    }
