<?php declare(strict_types=1);

/**
 * View Interface
 * @license https://opensource.org/licenses/MIT MIT
 * @author Renan Cavalieri <renan@tecdicas.com>
 */

namespace Pollus\ViewInterface;

use Psr\Http\Message\ResponseInterface;
use Pollus\ViewInterface\Exceptions\NullResponseException;

interface ViewInterface 
{
    /**
     * Sets the ResponseInterface
     * 
     * @param ResponseInterface $response
     * @return \Pollus\Mvc\Views\ViewInterface
     */
    public function setResponse(ResponseInterface $response) : ViewInterface;
    
    /**
     * Gets the response object
     * 
     * @return ResponseInterface
     */
    public function getResponse() : ResponseInterface;
    
    /**
     * Clears all stored variables
     */
    public function clear() : ViewInterface;
    
    /**
     * Gets a stored variable
     * 
     * @param string $variable
     * @returns mixed|null - Returns NULL when the variable doesn't exists
     */
    public function get(string $variable);
    
    /**
     * Sets a variable
     * 
     * @param string $variable
     * @param mixed $value
     * @return $this
     */
    public function set(string $variable, $value) : ViewInterface;
    
    /**
     * Merge an array with the stored variables
     * 
     * @param array $values
     */
    public function merge(array $values) : ViewInterface;
    
    /**
     * Renders a template and returns the response object
     * 
     * @param string $template Template name
     * @param array $vars Variables to be passed to the view (optional)
     * 
     * @return ResponseInterface
     */
    public function render(string $template, array $vars = []) : ResponseInterface;
    
    /**
     * Renders a template without modifying the response object and returns
     * the generated string
     * 
     * @param string $template Template name
     * @param array $vars Variables to be passed to the view (optional)
     * 
     * @return string;
     */
    public function renderWithoutResponse(string $template, array $vars = []) : string;
    
    /**
     * Renders a template block and returns the response object
     * 
     * @param string $template Template name
     * @param string $block Block name
     * @param array $vars Variables to be passed to the view (optional)
     * 
     * @return ResponseInterface
     * @throws NullResponseException if the response object is NULL
     */
    public function renderBlock(string $template, string $block, array $vars = []) : ResponseInterface;
    
    /**
     * Renders a template block without modifying the response object and returns
     * the generated string
     * 
     * @param string $template Template name
     * @param string $block Block name
     * @param array $vars Variables to be passed to the view (optional)
     * 
     * @return string The rendered content
     */
    public function renderBlockWithoutResponse(string $template, array $vars = []) : string;
    
    /**
     * Renders all stored variable as JSON and returns the response object
     * 
     * @param array $vars 
     * @param bool $merge_vars
     * 
     * @return ResponseInterface
     * @throws NullResponseException if the response object is NULL
     */
    public function renderAsJson(array $vars = array(), bool $merge_vars = false): ResponseInterface;
    
    /**
     * Renders all stored variable as JSON without modifying the response object
     * 
     * @param array $vars 
     * @param bool $merge_vars
     * 
     * @return ResponseInterface
     * @throws NullResponseException if the response object is NULL
     */
    public function renderAsJsonWithoutResponse(array $vars = array(), bool $merge_vars = false) : string;
}