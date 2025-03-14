# Vue3

2025-03-14 Study friday

I have some old Vue2 examples [here](https://github.com/peterlembke/vuejs-examples)
Those are obsolete. I will focus on Vue3 here.

## Motivation

I have always solved everything with pure Javascript. It is an easy language, and you can do anything in it.
At work we use Vue3. I asked LeChat.

**My question to Le Chat**

I am a seasoned Javascript developer that have developed in Javascript for 15 years and have built big systems. I use all technologies that are available in Javascript.
Now I am looking into what Vue can give me. I have seen the videos and there is just a lot of buzz words like: build faster, scale with ease...
My fear with a library is that I can no longer follow the call stacks and that it will get harder to debug with the browser tools.
What I am building is SPA single page applications with ONE route. I need code to be encapsulated in classes to avoid side effects and be reusable. I build for testability with a lot of pure functions.
Would Vue give me any benefits?

**Answer from Le Chat**

Vue.js can indeed offer several benefits for building single-page applications (SPAs), even if you are already experienced with JavaScript and other frameworks. Here are some key advantages that align with your requirements:

1. **Encapsulation and Reusability**:
    - Vue.js encourages a component-based architecture, which allows you to encapsulate functionality within self-contained components. This aligns well with your preference for encapsulating code in classes to avoid side effects and promote reusability. Each component in Vue can manage its own structure, style, and behavior, making it easier to build and maintain complex interfaces.

2. **Composables for Modularity**:
    - Vue 3 introduces the Composition API, which allows you to create composables—reusable functions that encapsulate specific logic. This can help you build modular and reusable units of code, enhancing the maintainability and testability of your applications. Composables can be easily shared and composed together, promoting a more organized and manageable codebase.

3. **Routing**:
    - Vue Router is a powerful library that integrates seamlessly with Vue.js, enabling you to manage routes efficiently within your SPA. It supports client-side navigation, allowing you to load different components without reloading the entire page. This can improve the user experience by providing faster and smoother transitions between views.

4. **Testability**:
    - Vue's component-based architecture and the use of composables make it easier to write unit tests. Each component or composable can be tested in isolation, ensuring that your code is reliable and maintainable. Vue also provides testing utilities that integrate well with popular testing frameworks.

5. **Performance Optimization**:
    - Vue offers various performance optimization techniques, such as lazy loading of components, which can reduce the initial load time of your application. By splitting your application into smaller chunks that are loaded on demand, you can improve the overall performance and user experience.

6. **Developer Experience**:
    - Vue provides a comprehensive set of tools and integrations that enhance the developer experience. This includes IDE support, browser devtools, and TypeScript integrations, which can make debugging and development more efficient. Vue's ecosystem also includes tools like Vue CLI and Vue Devtools, which can streamline your development workflow.

7. **Community and Ecosystem**:
    - Vue has a vibrant community and a rich ecosystem of plugins and libraries. This can be beneficial when you need to integrate additional functionality or find solutions to common problems. The community-driven resources and documentation can also be a valuable asset as you develop your applications.

In summary, Vue.js can provide you with a robust framework for building SPAs that are encapsulated, reusable, and testable. Its component-based architecture, composables, and powerful routing capabilities can help you create maintainable and performant applications. Additionally, Vue's developer tools and community support can enhance your development experience and help you overcome any challenges you may encounter.

## Goals

Todays goals are

* Demo.php - Get any Vue3 code working
* Compsition.php - Classes - Create a Composition with the Composition API
* Component.php - GUI component - Create a reusable component that is totally independent

Examples to the cour´ses: https://github.com/Code-Pop

## Demo

Load Vue3
Show something that only Vue3 can do.

https://www.vuemastery.com/courses/intro-to-vue-3/intro-to-vue3

## Composition

Create any code that is encapsulated. Just like one expect from a class.

https://www.vuemastery.com/courses/real-world-vue-3-composition-api/building-a-vue-3-app-composition-api

## Component

I want a button that has its CSS, HTML, Javascript code and input parameters.

https://www.vuemastery.com/courses/proven-component-patterns/patterns-introduction/

The input parameters are

* title
* event_name

The component will show a button.
When clicking the button a spinner on the right side INSIDE the button starts.
The button get disabled so no more clicks can be done.
The component send out an event and expect an answer.
When the answer comes back with answer and message:
* answer===true : Show a OK symbol instead of the spinner
* answer===false : Show a FAIL symbol instead of the spinner
* Show the message under the button.
* The button become enabled again

Then I will place three of these components on a page and see if they work independently.