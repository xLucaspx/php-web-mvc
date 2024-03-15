<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Product;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\NewProductDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;

class NewProductController implements RequestHandlerInterface
{
	public function __construct(
		private ProductRepository $productRepository
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$body = $request->getParsedBody();

		$typeId = filter_var($body['type'], FILTER_VALIDATE_INT);
		$name = filter_var($body['name']);
		$description = filter_var($body['description']);
		$price = filter_var($body['price'], FILTER_VALIDATE_FLOAT);

		// TODO: validations, process image trait
		$imageUrl = null;

		$files = $request->getUploadedFiles();
		/** @var UploadedFileInterface $uploadedImage */
		$uploadedImage = $files['image'];

		if ($uploadedImage->getError() === UPLOAD_ERR_OK) {
			$finfo = new \finfo(FILEINFO_MIME);
			$tempFile = $uploadedImage->getStream()->getMetadata('uri');
			$mimeType = $finfo->file($tempFile);

			if (str_starts_with($mimeType, 'image/')) {
				$safeFileName = uniqid('upload_') . "_" . pathinfo($uploadedImage->getClientFilename(), PATHINFO_BASENAME);
				$uploadedImage->moveTo(__DIR__ . '/../../../../public/img/produtos/' . $safeFileName);
				$imageUrl = $safeFileName;
			}
		}

		$product = new NewProductDto($typeId, $name, $description, $imageUrl, $price);

		$success = $this->productRepository->add($product);

		if (!$success) {
			// TODO: add error messages
		}

		return new Response(302, ['Location' => '/admin']);
	}
}
