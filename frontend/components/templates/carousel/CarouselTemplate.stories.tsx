import { ComponentMeta, ComponentStory } from '@storybook/react';
import CarouselTemplate, { ICarouselTemplate } from './CarouselTemplate';
import { mockCarouselTemplateProps } from './CarouselTemplate.mocks';

export default {
  title: 'templates/CarouselTemplate',
  component: CarouselTemplate,
  // More on argTypes: https://storybook.js.org/docs/react/api/argtypes
  argTypes: {},
} as ComponentMeta<typeof CarouselTemplate>;

// More on component templates: https://storybook.js.org/docs/react/writing-stories/introduction#using-args
const Template: ComponentStory<typeof CarouselTemplate> = (args) => (
  <CarouselTemplate {...args} />
);

export const Base = Template.bind({});
// More on args: https://storybook.js.org/docs/react/writing-stories/args

Base.args = {
  ...mockCarouselTemplateProps.base,
} as ICarouselTemplate;