<?php
/**
 * Created by grkr
 * Filename: SmartyStrategy.php
 * Date: 3/7/14
 * Time: 9:33 AM
 */

namespace GkSmarty\View;


use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\ViewEvent;

class SmartyStrategy implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * @var SmartyRenderer
     */
    protected $renderer;

    /**
     * @param SmartyRenderer $renderer
     */
    public function __construct(SmartyRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     * @param int $priority
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 100)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
        foreach($this->listeners as $index => $listener) {
            if($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Check if the renderer can load the requested template.
     *
     * @param ViewEvent $e
     * @return bool|SmartyRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        if($this->renderer->canRende($e->getModel()->getTemplate())) {
            return $this->renderer;
        }

        return false;
    }

    /**
     * Inject the response from the renderer.
     *
     * @param ViewEvent $e
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if($renderer !== $this->renderer) {
            // not our renderer
            return;
        }

        $result = $e->getResult();
        $response = $e->getResponse();

        $response->setContent($result);
    }
}