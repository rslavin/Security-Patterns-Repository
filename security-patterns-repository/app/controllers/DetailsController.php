<?php
class DetailsController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Details Controller
	|--------------------------------------------------------------------------
	|
	| Information for specific pattern details
	|
	*/

	public function showPatternById($id)
	{
		$pattern = Patterns::getSinglePatternById($id);
		$cwes = DB::table('cwe_map')
			->join('cwe_list', 'cwe_map.cwe_list_id', '=', 'cwe_list.cwe_list_id')
			->where('cwe_map.pattern_id', '=', $id)
			->get();
		
		if(Auth::check() && Auth::user()->role == 3){
			$scenario = UserSelection::getCurrentScenario(AUTH::user()->id);
			return View::make('pages.details', array('pattern'=> $pattern, 'cwes' => $cwes))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount())
				->nest('study_button', 'study.study_button', array('scenario' => $scenario, 'pattern_id' => $id));
		}
		
		
		return View::make('pages.details', array('pattern'=> $pattern, 'cwes' => $cwes))
				->nest('pattern_count', 'pages.count', Patterns::getPatternsCount());
	}

}
