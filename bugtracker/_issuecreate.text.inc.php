
Hi, %user_buddyname%!
<?="\n";?>
The following issue was created by <?php echo $issue->getPostedBy()->getName(); ?>:
<?="\n";?>
<?php echo $issue->getIssuetype()->getName(); ?> <?php echo $issue->getFormattedTitle(true); ?>
<?="\n";?>
* The issue was created with the following description *
<?="\n";?>
<?php echo str_replace('<br>','',tbg_parse_text($issue->getDescription())); ?>
<?="\n";?>
---
<?="\n";?>
Show issue: %thebuggenie_url%<?php echo str_replace('<br>','',make_url('viewissue', array('project_key' => $issue->getProject()->getKey(), 'issue_no' => $issue->getFormattedIssueNo()))); ?><?php echo "\n"; ?>
<?="\n";?>
Show <?php echo str_replace('<br>','',$issue->getProject()->getName()); ?> project dashboard: %thebuggenie_url%<?php echo str_replace('<br>','',make_url('project_dashboard', array('project_key' => $issue->getProject()->getKey()))); ?>
        
