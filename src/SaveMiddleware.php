<?php

/**
 * Laravel 4 - Persistant Settings
 * 
 * @author   Andreas Lutro <anlutro@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @package  l4-metatags
 */

namespace jaapgoorhuis\LaravelMetatags;

use Closure;
use jaapgoorhuis\LaravelMetatags\MetatagStore;
use Illuminate\Contracts\Routing\TerminableMiddleware;

class SaveMiddleware implements TerminableMiddleware
{
	/**
	 * Create a new save settings middleware
	 * 
	 * @param SettingStore $settings
	 */
	public function __construct(MetatagStore $metatags)
	{
		$this->metatags = $metatags;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$response = $next($request);
		
		return $response;
	}

	/**
	 * Perform any final actions for the request lifecycle.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Symfony\Component\HttpFoundation\Response  $response
	 * @return void
	 */
	public function terminate($request, $response)
	{
		$this->metatags->save();
	}
}