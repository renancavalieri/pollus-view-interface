<?php declare(strict_types=1);

/**
 * View Interface
 * @license https://opensource.org/licenses/MIT MIT
 * @author Renan Cavalieri <renan@tecdicas.com>
 */

namespace Pollus\ViewInterface\Tests;

use Pollus\ViewInterface\BaseView;
use Pollus\ViewInterface\ViewInterface;
use Psr\Http\Message\ResponseInterface;

class DumbView extends BaseView implements ViewInterface
{
    public function render(string $template, array $vars = array()): ResponseInterface
    {
        throw new \Exception("Not implemented");
    }

    public function renderBlock(string $template, string $block, array $vars = array()): ResponseInterface
    {
        throw new \Exception("Not implemented");
    }

    public function renderBlockWithoutResponse(string $template, array $vars = array()): string
    {
        throw new \Exception("Not implemented");
    }

    public function renderWithoutResponse(string $template, array $vars = array()): string
    {
        throw new \Exception("Not implemented");
    }
}
