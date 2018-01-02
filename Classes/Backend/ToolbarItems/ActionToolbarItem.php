<?php

namespace GeorgRinger\ToggleModules\Backend\ToolbarItems;

use TYPO3\CMS\Backend\Toolbar\ToolbarItemInterface;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Adds action links to the backend's toolbar
 */
class ActionToolbarItem implements ToolbarItemInterface
{

    /**
     * Render toolbar icon via Fluid
     *
     * @return string HTML
     */
    public function getItem()
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->loadRequireJsModule('TYPO3/CMS/ToggleModules/ToggleModule');
        return $this->getFluidTemplateObject('ToolbarItem.html')->render();
    }

    /**
     * Render drop down
     *
     * @return string HTML
     */
    public function getDropDown()
    {
        $view = $this->getFluidTemplateObject('DropDown.html');
        $view->assignMultiple([
            'states' => $this->getBackendUser()->uc['toggle_modules']['states']
        ]);
        return $view->render();
    }

    /**
     * Stores the entries for the action menu in $this->availableActions
     */
    protected function setAvailableActions()
    {
    }

    /**
     * This toolbar needs no additional attributes
     *
     * @return array
     */
    public function getAdditionalAttributes(): array
    {
        return [];
    }

    /**
     * This item has a drop down
     *
     * @return bool
     */
    public function hasDropDown(): bool
    {
        return true;
    }

    /**
     * This toolbar is rendered if there are action entries, no further user restriction
     *
     * @return bool
     */
    public function checkAccess(): bool
    {
        return $this->getBackendUser()->isAdmin();
    }

    /**
     * Position relative to others
     *
     * @return int
     */
    public function getIndex(): int
    {
        return 33;
    }

    /**
     * Returns the current BE user.
     *
     * @return BackendUserAuthentication
     */
    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * Returns a new standalone view, shorthand function
     *
     * @param string $filename Which templateFile should be used.
     * @return StandaloneView
     */
    protected function getFluidTemplateObject(string $filename): StandaloneView
    {
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths(['EXT:toggle_modules/Resources/Private/Layouts']);
        $view->setPartialRootPaths([
            'EXT:backend/Resources/Private/Partials/ToolbarItems',
            'EXT:toggle_modules/Resources/Private/Partials'
        ]);
        $view->setTemplateRootPaths(['EXT:toggle_modules/Resources/Private/Templates/ToolbarItems']);
        $view->setTemplate($filename);

        $view->getRequest()->setControllerExtensionName('ToggleModules');
        return $view;
    }
}
