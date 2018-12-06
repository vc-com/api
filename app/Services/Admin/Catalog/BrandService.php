<?php

namespace VoceCrianca\Services\Admin\Catalog;

use VoceCrianca\Repositories\Brand\BrandRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use VoceCrianca\Rules\ImageBase64ValidationRule;

/**
 * Class BrandService
 * @package VoceCrianca\Services\Admin\Catalog
 */
class BrandService
{

     /**
     * @var BrandRepositoryInterface
     */
    private $repository;

    /**
     * UserService constructor.
     * @param BrandRepositoryInterface $repository
     */
    public function __construct(BrandRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }  


    public function validator(Request $request, $id = '')
    {

        if ($request->input('image')) {

            return Validator::make($request->all(), [
                'image' => [new ImageBase64ValidationRule]
            ]);

        }

        if (isset($id)) {

            if ($request->input('action') === "edit-status") {
                return Validator::make($request->all(), [
                    'active' => 'required|boolean'
                ]);
            }

            return Validator::make($request->all(), [
                'name' => 'required|string|unique:brands,name,' . $id . ',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($request->all(), [
            'name' => 'required|string|unique:brands|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }

    public function create(Request $request)
    {
        $data = $request->all();

        if (!empty($request->image)) {
            $directoryBrand = storage_path("app" .
                DIRECTORY_SEPARATOR . "public" .
                DIRECTORY_SEPARATOR . "img" .
                DIRECTORY_SEPARATOR . "brand-logo");

            $data['image'] = createImageBase64(
                $directoryBrand, 
                $request->image,
                $request->name
            );

        }

        return $this->repository->create($data);

    }


    // public function update(Request $request)
    // {
    //     $data = $request->all();

    //     if (!empty($request->image)) {

    //         $newNameImage = time();
    //         $directoryBrand = storage_path("app" .
    //             DIRECTORY_SEPARATOR . "public" .
    //             DIRECTORY_SEPARATOR . "img" .
    //             DIRECTORY_SEPARATOR . "brand-logo");

    //         $ext = substr($request->image, 11, strpos($request->image, ';') - 11);
    //         $urlImage = $directoryBrand . DIRECTORY_SEPARATOR . $newNameImage;

    //         $file = str_replace('data:image/' . $ext . ';base64,', '', $request->image);
    //         $file = base64_decode($file);

    //         if (!file_exists($directoryBrand)) {
    //             mkdir($directoryBrand, 0755, true);
    //         }
    //     // if($request){
    //     //   $imgUser = str_replace(asset('/'),'',$request);
    //     //   if(file_exists($imgUser)){
    //     //     unlink($imgUser);
    //     //   }
    //     // }


    //         file_put_contents($urlImage, $file);
    //         $data['image'] = $urlImage;

           


            

    //     }

    //     $this->repository->create($data);
    // }

}
