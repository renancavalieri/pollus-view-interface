<?php declare(strict_types=1);

/**
 * View Interface
 * @license https://opensource.org/licenses/MIT MIT
 * @author Renan Cavalieri <renan@tecdicas.com>
 */

namespace Pollus\ViewInterface;

use Psr\Http\Message\ResponseInterface;
use Pollus\Mvc\Exceptions\ViewVariableException;
use Pollus\ViewInterface\Exceptions\NullResponseException;

abstract class BaseView implements ViewInterface, \ArrayAccess, \Countable
{
    /**
     * @var array
     */
    protected $vars;
    
    /**
     * @var ResponseInterface
     */
    protected $response;
    
    /**
     * {@inheritDoc}
     */
    public function clear() : ViewInterface
    {
        $this->vars = [];
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(): ResponseInterface 
    {
        return $this->response;
    }

    /**
     * {@inheritDoc}
     */
    public function merge(array $values) : ViewInterface
    {
        $this->vars = array_merge($this->vars, $values);
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setResponse(ResponseInterface $response) : ViewInterface
    {
        $this->response = $response;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key) 
    {
        $result = $this->vars[$key] ?? null;
        
        if ($result === null)
        {
            throw new ViewVariableException("A chave solicitada não existe");
        }
        
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, $value) : ViewInterface
    {
        $this->vars[$key] = $value;
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function renderAsJson(array $vars = array(), bool $merge_vars = false): ResponseInterface 
    {
        if ($merge_vars === true) $vars = array_merge($this->vars, $vars);
        
        $newresponse = $this->response->withHeader
        (
            'Content-type',
            'application/json; charset=utf-8'
        )
        ->write(json_encode($vars));
        
        return $newresponse;
    }
    
    /**
     * {@inheritDoc}
     */
    public function renderAsJsonWithoutResponse(array $vars = array(), bool $merge_vars = false): string 
    {
        if ($merge_vars === true) $vars = array_merge($this->vars, $vars);
        return json_encode($vars);
    }
    
    // ArrayAccess Interface 
    
    public function count(): int
    {
        return count($this->vars);
    }
    
    public function offsetExists($offset): bool
    {
        return (isset($this->vars[$offset])) ? true : false;
    }

    public function offsetGet($offset)
    {
        return $this->vars[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->vars[$offset] = $value;
    }
    
    public function offsetUnset($offset): void
    {
        unset($this->vars[$offset]);
    }
}
