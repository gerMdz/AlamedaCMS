// import { startStimulusApp } from '@symfony/stimulus-bridge';
import { Controller } from '@hotwired/stimulus';

// Registers Stimulus controllers from controllers.json and in the controllers/ directory
export const app = Controller(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.[jt]sx?$/
));

// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);
