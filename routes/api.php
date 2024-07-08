<?php

use App\Models\User;
use App\Http\Controllers\Api\{
    itemController, addressController, countryController, technologyController, statusController,
    shareholderMetaController, shareholderController, contactTypeController, contactController, tierTypeController, tierController, companyController, userController,

};
use App\Http\Controllers\Api\SegmentationController;
use App\Http\Controllers\Api\PricebookController;
use App\Http\Controllers\Api\PricebookTierController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReferenceController;
use App\Http\Controllers\Api\ProductReferenceController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductItemController;
use App\Http\Controllers\Api\ReferencePricebookController;
use App\Http\Controllers\Api\PriceMetaController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\CategorySegmentationController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Open Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::get('/profile', [AuthController::class, 'profile']);
  Route::get('/logout', [AuthController::class, 'logout']);
});

Route::name('settings.')->group(function () {
  Route::get('items', [itemController::class, 'index'])->name('items.index');
  Route::get('items/{id}', [ItemController::class, 'show'])->name('items.show');
  Route::put('items/{id}', [ItemController::class, 'update'])->name('items.update');
  Route::post('items', [itemController::class, 'postItems'])->name('items.store');
  Route::get('items/{id}/edit', [itemController::class, 'editItems']);
  Route::delete('items/{id}/delete', [itemController::class, 'deleteItems'])->name('items.destroy');

  Route::get('countries', [countryController::class, 'index'])->name('countries.index');
  Route::post('countries', [countryController::class, 'postCountry'])->name('countries.store');
  Route::get('countries/{id}', [countryController::class, 'getCountryById'])->name('countries.edit');
  Route::put('countries/{id}/edit', [countryController::class, 'updateCountry'])->name('countries.update');
  Route::delete('countries/{id}/delete', [countryController::class, 'deleteCountry'])->name('countries.destroy');


  Route::get('addresses', [addressController::class, 'index'])->name('addresses.index');
  Route::get('addresses/{id}', [addressController::class, 'show'])->name('addresses.show');
  Route::get('addresses/{id}/edit', [addressController::class, 'getAddressById'])->name('addresses.edit');
  Route::put('addresses/{id}/edit', [addressController::class, 'updateAddress'])->name('addresses.update');
  Route::post('addresses', [addressController::class, 'postAddress'])->name('addresses.store');
  Route::delete('addresses/{id}/delete', [addressController::class, 'deleteAddress'])->name('addresses.destroy');

  Route::get('technologies', [technologyController::class, 'index'])->name('technologies.index');
  Route::post('technologies', [technologyController::class, 'postTechnology'])->name('technologies.store');
  Route::get('technologies/{id}/edit', [technologyController::class, 'getTechnologyById'])->name('technologies.edit');
  Route::put('technologies/{id}/edit', [technologyController::class, 'updateTechnology'])->name('technologies.update');
  Route::delete('technologies/{id}/delete', [technologyController::class, 'deleteTechnology'])->name('technologies.destroy');

  Route::get('statuses', [statusController::class, 'index'])->name('statuses.index');
  Route::post('statuses', [statusController::class, 'postStatus'])->name('statuses.store');
  Route::get('statuses/{id}/edit', [statusController::class, 'getStatusById'])->name('statuses.edit');
  Route::put('statuses/{id}/edit', [statusController::class, 'updateStatus'])->name('statuses.update');
  Route::delete('statuses/{id}/delete', [statusController::class, 'deleteStatus'])->name('statuses.destroy');
});

Route::name('core.')->group(function () {
Route::get('shareholder_metas', [shareholderMetaController::class, 'index'])->name('shareholder-metas.index');
  Route::post('shareholder_metas', [shareholderMetaController::class, 'postShareholder_meta'])->name('shareholder-metas.store');
  Route::get('shareholder_metas/{id}/edit', [shareholderMetaController::class, 'getShareholder_metaById'])->name('shareholder-metas.edit');
  Route::put('shareholder_metas/{id}/edit', [shareholderMetaController::class, 'updateShareholder_meta'])->name('shareholder-metas.update');
  Route::delete('shareholder_metas/{id}/delete', [shareholderMetaController::class, 'deleteShareholder_meta'])->name('shareholder-metas.destroy');

  Route::get('shareholders', [shareholderController::class, 'index'])->name('shareholders.index');
  Route::post('shareholders', [shareholderController::class, 'postShareholder'])->name('shareholders.store');
  Route::get('shareholders/{id}/edit', [shareholderController::class, 'getShareholderById'])->name('shareholders.edit');
  Route::put('shareholders/{id}/edit', [shareholderController::class, 'updateShareholder'])->name('shareholders.update');
  Route::delete('shareholders/{id}/delete', [shareholderController::class, 'deleteShareholder'])->name('shareholders.destroy');

  Route::get('contact_types', [contactTypeController::class, 'index'])->name('contact-types.index');
  Route::post('contact_types', [contactTypeController::class, 'postContact_type'])->name('contact-types.store');
  Route::get('contact_types/{id}/edit', [contactTypeController::class, 'getContact_typeById'])->name('contact-types.edit');
  Route::put('contact_types/{id}/edit', [contactTypeController::class, 'updateContact_type'])->name('contact-types.update');
  Route::delete('contact_types/{id}/delete', [contactTypeController::class, 'deleteContact_type'])->name('contact-types.destroy');

  Route::get('contacts', [contactController::class, 'index'])->name('contacts.index');
  Route::get('/contacts/{id}', [contactController::class, 'show'])->name('contacts.show');
  Route::post('contacts', [contactController::class, 'postContact'])->name('contacts.store');
  Route::get('contacts/{id}/edit', [contactController::class, 'getContactById'])->name('contacts.edit');
  Route::put('contacts/{id}/edit', [contactController::class, 'updateContact'])->name('contacts.update');
  Route::delete('contacts/{id}/delete', [contactController::class, 'deleteContact'])->name('contacts.destroy');

  Route::get('tier_types', [tierTypeController::class, 'index'])->name('tier-types.index');
  Route::post('tier_types', [tierTypeController::class, 'postTier_type'])->name('tier-types.store');
  Route::get('tier_types/{id}/edit', [tierTypeController::class, 'getTier_typeById'])->name('tier-types.edit');
  Route::put('tier_types/{id}/edit', [tierTypeController::class, 'updateTier_type'])->name('tier-types.update');
  Route::delete('tier_types/{id}/delete', [tierTypeController::class, 'deleteTier_type'])->name('tier-types.destroy');

  Route::get('tiers', [tierController::class, 'index'])->name('tiers.index');
  Route::post('tiers', [tierController::class, 'postTier'])->name('tiers.store');
  Route::get('tiers/{id}/edit', [tierController::class, 'getTierById'])->name('tiers.edit');
  Route::put('tiers/{id}/edit', [tierController::class, 'updateTier'])->name('tiers.update');
  Route::delete('tiers/{id}/delete', [tierController::class, 'destroy'])->name('tiers.destroy');

  Route::get('companies', [companyController::class, 'index'])->name('companies.index');
  Route::get('/companies/{id}', [companyController::class, 'show'])->name('companies.show');
  Route::post('companies', [companyController::class, 'postCompany'])->name('companies.store');
  Route::get('companies/{id}/edit', [companyController::class, 'getCompanyById'])->name('companies.edit');
  Route::put('companies/{id}/edit', [companyController::class, 'updateCompany'])->name('companies.update');
  Route::delete('companies/{id}/delete', [companyController::class, 'deleteCompany'])->name('companies.destroy');

  Route::get('users', [userController::class, 'index'])->name('users.index');
  Route::get('/users/{id}', [userController::class, 'show'])->name('users.show');
  Route::post('users', [userController::class, 'postUser'])->name('users.store');
  Route::get('users/{id}/edit', [userController::class, 'getUserById'])->name('users.edit');
  Route::put('users/{id}/edit', [userController::class, 'updateUser'])->name('users.update');
  Route::delete('users/{id}/delete', [userController::class, 'deleteUser'])->name('users.destroy');
});

Route::name('product-manager.')->group(function () {
  Route::get('segmentations', [SegmentationController::class, 'index'])->name('segmentations.index');
  Route::post('segmentations', [SegmentationController::class, 'store'])->name('segmentations.store');
  Route::get('segmentations/{id}', [SegmentationController::class, 'show'])->name('segmentations.show');
  Route::put('segmentations/{id}', [SegmentationController::class, 'update'])->name('segmentations.update');
  Route::delete('segmentations/{id}', [SegmentationController::class, 'destroy'])->name('segmentations.destroy');

  Route::get('pricebooks', [PricebookController::class, 'index'])->name('pricebooks.index');
  Route::post('pricebooks', [PricebookController::class, 'store'])->name('pricebooks.store');
  Route::get('pricebooks/{id}', [PricebookController::class, 'show'])->name('pricebooks.show');
  Route::put('pricebooks/{id}', [PricebookController::class, 'update'])->name('pricebooks.update');
  Route::delete('pricebooks/{id}', [PricebookController::class, 'destroy'])->name('pricebooks.destroy');

  Route::get('pricebook-tier', [PricebookTierController::class, 'index'])->name('pricebook-tier.index');
  Route::post('pricebook-tier', [PricebookTierController::class, 'store'])->name('pricebook-tier.store');
  Route::get('pricebook-tier/{id}', [PricebookTierController::class, 'show'])->name('pricebook-tier.show');
  Route::put('pricebook-tier/{id}', [PricebookTierController::class, 'update'])->name('pricebook-tier.update');
  Route::delete('pricebook-tier/{id}', [PricebookTierController::class, 'destroy'])->name('pricebook-tier.destroy');

  Route::get('products', [ProductController::class, 'index'])->name('products.index');
  Route::post('products', [ProductController::class, 'store'])->name('products.store');
  Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
  Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
  Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

  Route::get('references', [ReferenceController::class, 'index'])->name('references.index');
  Route::post('references', [ReferenceController::class, 'store'])->name('references.store');
  Route::get('references/{id}', [ReferenceController::class, 'show'])->name('references.show');
  Route::put('references/{id}', [ReferenceController::class, 'update'])->name('references.update');
  Route::delete('references/{id}', [ReferenceController::class, 'destroy'])->name('references.destroy');

  Route::get('product-references', [ProductReferenceController::class, 'index'])->name('product-references.index');
  Route::post('product-references', [ProductReferenceController::class, 'store'])->name('product-references.store');
  Route::get('product-references/{productId}/{referenceId}', [ProductReferenceController::class, 'show'])->name('product-references.show');
  Route::put('product-references/{productId}/{referenceId}', [ProductReferenceController::class, 'update'])->name('product-references.update');
  Route::delete('product-references/{productId}/{referenceId}', [ProductReferenceController::class, 'destroy'])->name('product-references.destroy');

  Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
  Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
  Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
  Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
  Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

  Route::get('product-items', [ProductItemController::class, 'index'])->name('product-items.index');
  Route::post('product-items', [ProductItemController::class, 'store'])->name('product-items.store');
  Route::get('product-items/{product_id}/{item_id}', [ProductItemController::class, 'show'])->name('product-items.show');
  Route::put('product-items/{product_id}/{item_id}', [ProductItemController::class, 'update'])->name('product-items.update');
  Route::delete('product-items/{product_id}/{item_id}', [ProductItemController::class, 'destroy'])->name('product-items.destroy');

  Route::get('reference-pricebooks', [ReferencePricebookController::class, 'index'])->name('reference-pricebooks.index');
  Route::post('reference-pricebooks', [ReferencePricebookController::class, 'store'])->name('reference-pricebooks.store');
  Route::get('reference-pricebooks/{pricebook_id}/{reference_id}', [ReferencePricebookController::class, 'show'])->name('reference-pricebooks.show');
  Route::put('reference-pricebooks/{pricebook_id}/{reference_id}', [ReferencePricebookController::class, 'update'])->name('reference-pricebooks.update');
  Route::delete('reference-pricebooks/{pricebook_id}/{reference_id}', [ReferencePricebookController::class, 'destroy'])->name('reference-pricebooks.destroy');

  Route::get('price-metas', [PriceMetaController::class, 'index'])->name('price-metas.index');
  Route::post('price-metas', [PriceMetaController::class, 'store'])->name('price-metas.store');
  Route::get('price-metas/{id}', [PriceMetaController::class, 'show'])->name('price-metas.show');
  Route::put('price-metas/{id}', [PriceMetaController::class, 'update'])->name('price-metas.update');
  Route::delete('price-metas/{id}', [PriceMetaController::class, 'destroy'])->name('price-metas.destroy');

  Route::get('prices', [PriceController::class, 'index'])->name('prices.index');
  Route::post('prices', [PriceController::class, 'store'])->name('prices.store');
  Route::get('prices/{id}', [PriceController::class, 'show'])->name('prices.show');
  Route::put('prices/{id}', [PriceController::class, 'update'])->name('prices.update');
  Route::delete('prices/{id}', [PriceController::class, 'destroy'])->name('prices.destroy');

  Route::get('category-segmentations', [CategorySegmentationController::class, 'index'])->name('category-segmentations.index');
  Route::post('category-segmentations', [CategorySegmentationController::class, 'store'])->name('category-segmentations.store');
  Route::delete('category-segmentations/{category_id}/{segmentation_id}', [CategorySegmentationController::class, 'destroy'])->name('category-segmentations.destroy');
});
