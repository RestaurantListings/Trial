<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/13/15
 * Time: 11:40 PM
 */
 namespace App\Http\Controllers;

 use App\Http\Requests;

 use Input;


class SearchController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Search Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's search methods.
    |
    */

     /*
     * Search the restaurants based on the request.
     *F
     * @return Response
     */
    public function search()
    {
      $data = \Input::all();
        return $data;
    }

}
