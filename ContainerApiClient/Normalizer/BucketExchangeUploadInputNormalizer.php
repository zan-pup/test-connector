<?php

namespace Productsup\ContainerApi\Client\Normalizer;

use Jane\Component\JsonSchemaRuntime\Reference;
use Productsup\ContainerApi\Client\Runtime\Normalizer\CheckArray;
use Productsup\ContainerApi\Client\Runtime\Normalizer\ValidatorTrait;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class BucketExchangeUploadInputNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    use ValidatorTrait;
    public function supportsDenormalization($data, $type, $format = null) : bool
    {
        return $type === 'Productsup\\ContainerApi\\Client\\Model\\BucketExchangeUploadInput';
    }
    public function supportsNormalization($data, $format = null) : bool
    {
        return is_object($data) && get_class($data) === 'Productsup\\ContainerApi\\Client\\Model\\BucketExchangeUploadInput';
    }
    /**
     * @return mixed
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \Productsup\ContainerApi\Client\Model\BucketExchangeUploadInput();
        if (null === $data || false === \is_array($data)) {
            return $object;
        }
        if (\array_key_exists('source_file', $data) && $data['source_file'] !== null) {
            $object->setSourceFile($data['source_file']);
            unset($data['source_file']);
        }
        elseif (\array_key_exists('source_file', $data) && $data['source_file'] === null) {
            $object->setSourceFile(null);
        }
        foreach ($data as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $object[$key] = $value;
            }
        }
        return $object;
    }
    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if ($object->isInitialized('sourceFile') && null !== $object->getSourceFile()) {
            $data['source_file'] = $object->getSourceFile();
        }
        foreach ($object as $key => $value) {
            if (preg_match('/.*/', (string) $key)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}