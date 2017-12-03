import React from 'react';
import SubView from '../SubView';
import GameStore from '../../../stores/GameStore';

export default class WelcomeView
extends SubView {
  _initialData() {
    return !GameStore.loadRole(this._characterSlug());
  }

  _characterSlug() {
    return this.props.match.params.characterSlug;
  }

  onGameStoreUpdate() {
    super.onGameStoreUpdate(
      GameStore.getRole()
    );
  }

  _eyebrow() {
    return 'Welcome';
  }

  _title() {
    return this.state.data.guest;
  }

  _renderContent() {
    return (
      <div className={this.bem.el('section', 'copy')}>
        {this.renderSection(
          'TLDR;',
          [
            <p>You have a role you will play. (And hopefully an correpsonding costume.) In the next two days, you will find out how you know other people. The evening of, you will be given instructions for each act. There will be murder. (It is predermined.) At the end, you will submit an accusation and vote of who played the best character.</p>,
          ]
        )}

        {this.renderSection(
          'Preparation',
          [
            <p>For those of you, who haven’t been to a murder mystery party, here’s how the event will go.</p>,

            <p>You currently have access to a brief back story and preliminary information about your chracter in the <i>Story</i> and <i>Role</i> sections respectively to allow you to do any costume preperation you’d like.</p>,

            <p>In the next two days, you will recieve another email notifiying you that your relationships have been posted. In the <i>Role</i> section, you will be able to see how you know certain characters and what information you know about them. Keep in mind that they cannot see that information. You may know things ab out them that they are unaware of and vice versa. You will only be able to see their <i>Bio</i>, but will see more information about your role, e.g. <i>Appearance</i>, <i>Story & Motive</i>.</p>,

            <p><strong>Importantly</strong>, your character may have motive to murder someone, but that does not indicate that you are the murderer. It is entirely possible, to not know you are the murder until an act begins.</p>,

            <p><em>Please review this before hand as it will be very relevant to the evening and don’t share any information about your character with others.</em></p>,
          ]
        )}

        {this.renderSection(
          'The Evening',
          [
            <p>On the evening of the party, instructions will appear on the <i>Acts</i> section telling you what you need to accomplish during that act. Instructions will continue to appear through out the evening at the beginning at each act. Be sure to pay attention to what others are doing and saying as it will be crucial in solving the game.</p>,
          ]
        )}

        {this.renderSection(
          'The Conclusion',
          [
            <p>After the final act, you will be shown a screen allowing you to place accusations and vote for the best character preformance. Once everyone has voted, you will be able to see the how the night unfolded, if your accusation was correct, and who was voted best character.</p>,
          ]
        )}
      </div>
    );
  }
}
