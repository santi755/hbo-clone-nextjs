import { ComponentMeta, ComponentStory } from '@storybook/react';
import ButtonInputs, { IButtonInputs } from './ButtonInputs';
import { mockButtonInputsProps } from './ButtonInputs.mocks';

export default {
  title: 'templates/ButtonInputs',
  component: ButtonInputs,
  // More on argTypes: https://storybook.js.org/docs/react/api/argtypes
  argTypes: {},
} as ComponentMeta<typeof ButtonInputs>;

// More on component templates: https://storybook.js.org/docs/react/writing-stories/introduction#using-args
const Template: ComponentStory<typeof ButtonInputs> = (args) => (
  <ButtonInputs {...args} />
);

export const Base = Template.bind({});
// More on args: https://storybook.js.org/docs/react/writing-stories/args

Base.args = {
  ...mockButtonInputsProps.base,
} as IButtonInputs;