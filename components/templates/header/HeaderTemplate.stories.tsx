import { ComponentMeta, ComponentStory } from '@storybook/react';
import HeaderTemplate, { IHeaderTemplate } from './HeaderTemplate';
import { mockHeaderTemplateProps } from './HeaderTemplate.mocks';

export default {
  title: 'templates/HeaderTemplate',
  component: HeaderTemplate,
  // More on argTypes: https://storybook.js.org/docs/react/api/argtypes
  argTypes: {},
} as ComponentMeta<typeof HeaderTemplate>;

// More on component templates: https://storybook.js.org/docs/react/writing-stories/introduction#using-args
const Template: ComponentStory<typeof HeaderTemplate> = (args) => (
  <HeaderTemplate {...args} />
);

export const Base = Template.bind({});
// More on args: https://storybook.js.org/docs/react/writing-stories/args

Base.args = {
  ...mockHeaderTemplateProps.base,
} as IHeaderTemplate;