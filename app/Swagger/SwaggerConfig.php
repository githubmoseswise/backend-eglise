<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="User api",
 *         version="1.0.0",
 *         description="Registration of user"
 *     ),
 *     @OA\Server(
 *         url="/api",
 *         description="Base URL"
 *     )
 * )
 */
class SwaggerConfig
{
    // Vous pouvez ajouter d'autres configurations si nécessaire
}
