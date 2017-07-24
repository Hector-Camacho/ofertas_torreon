<?php

class CategoriaController extends BaseController {
	
	public function Categoria ($page_id) {
		$categorias = Categoria::all();
		$pageLimit = $page_id;
		//Articulos sin patrocinio
		$articulos = DB::table('articulos')->select('articulos.Nombre','articulos.FechaPublicacion','articulos.UbicacionArticulo','articulos.TipoVenta','articulos.id','articulos.Precio','articulos.NombreImagen1','articulos.Status')->whereNotIn('id', function($query){
				$query->select('idArticulos')->from('articulosdestacados');
			})->orderBy('id','desc')->get();


		$Patrocinadas = DB::table('articulosdestacados')->join('articulos','articulos.id','=','articulosdestacados.idArticulos')->select('articulos.Nombre','articulos.FechaPublicacion','articulos.UbicacionArticulo','articulos.TipoVenta','articulos.id','articulos.Precio','articulos.NombreImagen1','articulos.Status')->where('status','=',0)->get();

		if (!empty($articulos)) {
			return View::make('Categoria')->with('Categorias', $categorias)->with('Articulos', $articulos)->with('limit', $pageLimit)->with('Patrocinadas',$Patrocinadas);
		} else {
			return Redirect::to('/');
		}
	}

	public function Subcategoria ($subcategoria, $page_id) {
		$categorias = Categoria::all();
		$pageLimit = $page_id;
		$sub_id = $subcategoria;
		
		//Articulos sin patrocinio
		$articulos = DB::table('articulos')->select('articulos.Nombre','articulos.FechaPublicacion','articulos.UbicacionArticulo','articulos.TipoVenta','articulos.id','articulos.Precio','articulos.NombreImagen1','articulos.Status')->where('subcategoria_id', '=', $subcategoria)->whereNotIn('id', function($query){
				$query->select('idArticulos')->from('articulosdestacados');
			})->orderBy('id','desc')->get();
		
		//Articulos patrocinados
		$Patrocinadas = DB::table('articulosdestacados')->join('articulos','articulos.id','=','articulosdestacados.idArticulos')->select('articulos.Nombre','articulos.FechaPublicacion','articulos.UbicacionArticulo','articulos.TipoVenta','articulos.id','articulos.Precio','articulos.NombreImagen1','articulos.Status')->where('subcategoria_id','=',$subcategoria)->where('status','=',0)->get();

		//Retorna la vista con los datos
		return View::make('SubCategoria')->with('Categorias', $categorias)->with('Articulos', $articulos)->with('limit', $pageLimit)->with('sub_id', $sub_id)->with('Patrocinadas',$Patrocinadas);
	
	}
}
