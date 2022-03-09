<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Exception;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *      path="/appartement",
 *      operationId="getAllProperties",
 *      tags={"Get"},

 *      summary="Récupéré la liste des propriétés",
 *      description="Retourne la liste complète de toute les propriétés.",
 *      @OA\Response(
 *          response=200,
 *          description="Opération réussis",
 *          @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Non authentifié",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Accès refusé"
 *      ),
 * @OA\Response(
 *      response=400,
 *      description="Requête erroné"
 *   ),
 * @OA\Response(
 *      response=404,
 *      description="Page introuvable"
 *   ),
 *  )
 */


class PropertyController extends Controller
{
    public function Index()
    {
        return view('Property', [
            'title' => 'hello moto',
            'content' => "je suis un test",
        ]);
    }

    public function All()
    {
        $property = response()
            ->json(Property::all());
        return $property;
    }

    public function Get($id)
    {
        $propertyById = Property::find($id);
        return response()->json($propertyById);
    }

    /**
     * @OA\Get(
     *      path="/appartement/{id}",
     *      operationId="getProperty",
     *      tags={"Get"},
     *      summary="Récupéré une propriétée",
     *      description="Retourne une propriétée.",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="l'id de la propriété",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Requête erroné"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="Page introuvable"
     *   ),
     *  )
     */

    public function show($id)
    {
        $property = Property::findOrFail($id);
        if ($property == null) {
            throw new Exception("Propriété inexistante", 404);
        }
        return $property;
    }

    /**
     * @OA\Put(
     *      path="/appartement/modify/{id}",
     *      summary="Modifié une propriété",
     *      operationId="Modify Property",
     *      tags={"Modify"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="l'id de la propriété",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Proprietes",
     *      @OA\JsonContent(
     *          required={"title", "description", "size", "floor", "image", "room", "price", "address", "postcode", "city"},
     *          @OA\Property(property="title", type="string"),
     *          @OA\Property(property="description", type="string"),
     *          @OA\Property(property="image", type="string"),
     *          @OA\Property(property="address", type="string"),
     *          @OA\Property(property="postcode", type="string"),
     *          @OA\Property(property="city", type="string"),
     *          @OA\Property(property="room", type="number"),
     *          @OA\Property(property="price", type="number"),
     *          @OA\Property(property="size", type="number"),
     *          @OA\Property(property="floor", type="number"),
     *      ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *      @OA\Response(
     *      response=404,
     *      description="Page introuvable"
     *      ),
     *  )
     */

    public function modify(Request $request, $id)
    {

        $this->validate($request, [
            'title' => "required",
            'description' => "required",
            'size' => "required",
            'floor' => "required",
            'image' => "required",
            'room' => "required",
            'price' => "required",
            'address' => "required",
            'postcode' => "required",
            'city' => "required",
        ]);

        $property = Property::findOrFail($id);
        if ($property == null) {
            throw new Exception("Propriété inexistante", 404);
        }

        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'size' => $request->size,
            'floor' => $request->floor,
            'image' => $request->image,
            'room' => $request->room,
            'price' => $request->price,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'city' => $request->city,
        ]);

        return response()->json();
    }

    /**
     * @OA\Post(
     *      path="/appartement/add",
     *      summary="Ajouter une propriété",
     *      operationId="AddOneProperty",
     *      tags={"Create"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Proprietes",
     *      @OA\JsonContent(
     *          required={"title", "description", "image", "postcode", "city", "address", "room", "price", "size", "floor" },
     *          @OA\Property(property="title", type="string"),
     *          @OA\Property(property="description", type="string"),
     *          @OA\Property(property="image", type="string"),
     *          @OA\Property(property="address", type="string"),
     *          @OA\Property(property="postcode", type="string"),
     *          @OA\Property(property="city", type="string"),
     *          @OA\Property(property="room", type="number"),
     *          @OA\Property(property="price", type="number"),
     *          @OA\Property(property="size", type="number"),
     *          @OA\Property(property="floor", type="number"),
     *      ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *  )
     */

    public function add(Request $request)
    {
        $property =
            Property::create([
                'title' => $request->title,
                'description' => $request->description,
                'size' => $request->size,
                'floor' => $request->floor,
                'image' => $request->image,
                'room' => $request->room,
                'price' => $request->price,
                'address' => $request->address,
                'postcode' => $request->postcode,
                'city' => $request->city,
            ]);
        return response()->json($property, 201);
    }

    /**
     * @OA\Delete(
     *      path="/appartement/delete/{id}",
     *      operationId="DeleteProperty",
     *      tags={"Delete"},
     *      summary="delete one property",
     *      description="delete one property.",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Delete one property",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Opération réussis",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Non authentifié",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Accès refusé"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Requête erroné"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="Page introuvable"
     *   ),
     *  )
     */
    public function delete($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();
        return response()->json();
    }
}
