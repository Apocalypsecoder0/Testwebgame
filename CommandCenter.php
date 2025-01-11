<?php

class CommandCenter {
    private $commands = [];

    public function registerCommand($name, callable $command) {
        $this->commands[$name] = $command;
    }

    public function executeCommand($name, ...$args) {
        if (isset($this->commands[$name])) {
            return call_user_func($this->commands[$name], ...$args);
        } else {
            throw new Exception("Command not found: $name");
        }
    }
}

// Example usage
$commandCenter = new CommandCenter();

// Registering commands
$commandCenter->registerCommand('greet', function($name) {
    return "Hello, $name!";
});

$commandCenter->registerCommand('add', function($a, $b) {
    return $a + $b;
});

// Executing commands
try {
    echo $commandCenter->executeCommand('greet', 'Alice') . PHP_EOL; // Output: Hello, Alice!
    echo $commandCenter->executeCommand('add', 5, 10) . PHP_EOL; // Output: 15
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
