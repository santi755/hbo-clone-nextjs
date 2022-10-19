import { ComponentMeta, ComponentStory } from '@storybook/react';
import ButtonUi, { IButtonUi } from './ButtonUi';
import { mockButtonUiProps } from './ButtonUi.mocks';

export default {
  title: 'templates/ButtonUi',
  component: ButtonUi,
  // More on argTypes: https://storybook.js.org/docs/react/api/argtypes
  argTypes: {},
} as ComponentMeta<typeof ButtonUi>;

// More on component templates: https://storybook.js.org/docs/react/writing-stories/introduction#using-args
const Template: ComponentStory<typeof ButtonUi> = (args) => (
  <ButtonUi {...args} />
);

export const Base = Template.bind({});
// More on args: https://storybook.js.org/docs/react/writing-stories/args

Base.args = {
  ...mockButtonUiProps.base,
} as IButtonUi;