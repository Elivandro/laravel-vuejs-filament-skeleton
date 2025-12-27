<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactFormRequest;
use App\Http\Resources\TenantResource;
use App\Jobs\SendMailTenantUserJob;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends Controller
{
    public function home(): JsonResource
    {
        return new TenantResource(tenant()->load(['domains', 'users']));
    }

    public function contact(ContactFormRequest $request): JsonResponse
    {
        try {

            /**
             * @var ownerTenant \App\Models\User
             */
            $ownerTenant = tenant()->users()->first();

            if (is_null($ownerTenant)) response()->json(['error' => 'Nenhum usuário encontrado'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

            SendMailTenantUserJob::dispatch($ownerTenant, $request->validated());

            return response()->json(['success' => 'Mensagem enviada com sucesso'], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()], JsonResponse::HTTP_FORBIDDEN);
        }
    }
}
