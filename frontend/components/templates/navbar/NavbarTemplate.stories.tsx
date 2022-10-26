import { ComponentMeta, ComponentStory } from '@storybook/react';
import NavbarTemplate, { INavbarTemplate } from './NavbarTemplate';
import { mockNavbarTemplateProps } from './NavbarTemplate.mocks';

export default {
  title: 'templates/NavbarTemplate',
  component: NavbarTemplate,
  // More on argTypes: https://storybook.js.org/docs/react/api/argtypes
  argTypes: {},
} as ComponentMeta<typeof NavbarTemplate>;

// More on component templates: https://storybook.js.org/docs/react/writing-stories/introduction#using-args
const Template: ComponentStory<typeof NavbarTemplate> = (args) => (
  <NavbarTemplate {...args} />
);

export const Base = Template.bind({});
// More on args: https://storybook.js.org/docs/react/writing-stories/args

Base.args = {
  ...mockNavbarTemplateProps.base,
} as INavbarTemplate;