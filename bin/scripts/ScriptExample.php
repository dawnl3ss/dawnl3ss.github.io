<?php

namespace Programming;

use Aether\Modules\AetherCLI\Cli\CliColorEnum;
use Aether\Modules\AetherCLI\Script\BaseScript;


class ScriptExample extends BaseScript {

    public function _onLoad() : void {
        $this->_getLogger()->_echo("Loading script example...", CliColorEnum::FG_CYAN);
    }

    /**
     * @return bool
     */
    public function _onRun() : bool {
        $this->_getLogger()->_echo("Executing script example", CliColorEnum::FG_CYAN);
        return true;
    }
}