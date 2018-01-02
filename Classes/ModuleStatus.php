<?php
namespace GeorgRinger\ToggleModules;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Status of tasks
 */
class ModuleStatus
{
    /**
     * Saves the section toggle state of tasks in the backend user's uc
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function saveToggleState(ServerRequestInterface $request, ResponseInterface $response)
    {
        // Remove 'el_' in the beginning which is needed for the saveSortingState()
        $item = isset($request->getParsedBody()['item']) ? $request->getParsedBody()['item'] : $request->getQueryParams()['item'];
        $state = (bool)(isset($request->getParsedBody()['state']) ? $request->getParsedBody()['state'] : $request->getQueryParams()['state']);

        $this->getBackendUserAuthentication()->uc['toggle_modules']['states'][$item] = $state;
        $this->getBackendUserAuthentication()->writeUC();

        return $response;
    }

    /**
     * Returns BackendUserAuthentication
     *
     * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    protected function getBackendUserAuthentication()
    {
        return $GLOBALS['BE_USER'];
    }
}
