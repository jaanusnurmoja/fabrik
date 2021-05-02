<?php
// This file was auto-generated from sdk-root/src/data/mgh/2017-05-31/api-2.json
return [
    'version'   => '2.0', 'metadata' => ['apiVersion' => '2017-05-31', 'endpointPrefix' => 'mgh', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'AWS Migration Hub', 'signatureVersion' => 'v4', 'targetPrefix' => 'AWSMigrationHub', 'uid' => 'AWSMigrationHub-2017-05-31',], 'operations' => [
        'AssociateCreatedArtifact' => ['name' => 'AssociateCreatedArtifact', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'AssociateCreatedArtifactRequest',], 'output' => ['shape' => 'AssociateCreatedArtifactResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'AssociateDiscoveredResource' => ['name' => 'AssociateDiscoveredResource', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'AssociateDiscoveredResourceRequest',], 'output' => ['shape' => 'AssociateDiscoveredResourceResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'PolicyErrorException',], ['shape' => 'ResourceNotFoundException',],],], 'CreateProgressUpdateStream' => ['name' => 'CreateProgressUpdateStream', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'CreateProgressUpdateStreamRequest',], 'output' => ['shape' => 'CreateProgressUpdateStreamResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',],],], 'DeleteProgressUpdateStream' => ['name' => 'DeleteProgressUpdateStream', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'DeleteProgressUpdateStreamRequest',], 'output' => ['shape' => 'DeleteProgressUpdateStreamResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'DescribeApplicationState' => ['name' => 'DescribeApplicationState', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'DescribeApplicationStateRequest',], 'output' => ['shape' => 'DescribeApplicationStateResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'InvalidInputException',], ['shape' => 'PolicyErrorException',], ['shape' => 'ResourceNotFoundException',],],], 'DescribeMigrationTask' => ['name' => 'DescribeMigrationTask', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'DescribeMigrationTaskRequest',], 'output' => ['shape' => 'DescribeMigrationTaskResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'DisassociateCreatedArtifact' => ['name' => 'DisassociateCreatedArtifact', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'DisassociateCreatedArtifactRequest',], 'output' => ['shape' => 'DisassociateCreatedArtifactResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'DisassociateDiscoveredResource' => ['name' => 'DisassociateDiscoveredResource', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'DisassociateDiscoveredResourceRequest',], 'output' => ['shape' => 'DisassociateDiscoveredResourceResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'ImportMigrationTask' => ['name' => 'ImportMigrationTask', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'ImportMigrationTaskRequest',], 'output' => ['shape' => 'ImportMigrationTaskResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'ListCreatedArtifacts' => ['name' => 'ListCreatedArtifacts', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'ListCreatedArtifactsRequest',], 'output' => ['shape' => 'ListCreatedArtifactsResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'ListDiscoveredResources' => ['name' => 'ListDiscoveredResources', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'ListDiscoveredResourcesRequest',], 'output' => ['shape' => 'ListDiscoveredResourcesResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'ListMigrationTasks' => ['name' => 'ListMigrationTasks', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'ListMigrationTasksRequest',], 'output' => ['shape' => 'ListMigrationTasksResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'InvalidInputException',], ['shape' => 'PolicyErrorException',], ['shape' => 'ResourceNotFoundException',],],], 'ListProgressUpdateStreams' => ['name' => 'ListProgressUpdateStreams', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'ListProgressUpdateStreamsRequest',], 'output' => ['shape' => 'ListProgressUpdateStreamsResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'InvalidInputException',],],], 'NotifyApplicationState' => ['name' => 'NotifyApplicationState', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'NotifyApplicationStateRequest',], 'output' => ['shape' => 'NotifyApplicationStateResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'PolicyErrorException',], ['shape' => 'ResourceNotFoundException',],],], 'NotifyMigrationTaskState' => ['name' => 'NotifyMigrationTaskState', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'NotifyMigrationTaskStateRequest',], 'output' => ['shape' => 'NotifyMigrationTaskStateResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],], 'PutResourceAttributes' => ['name' => 'PutResourceAttributes', 'http' => ['method' => 'POST', 'requestUri' => '/',], 'input' => ['shape' => 'PutResourceAttributesRequest',], 'output' => ['shape' => 'PutResourceAttributesResult',], 'errors' => [['shape' => 'AccessDeniedException',], ['shape' => 'InternalServerError',], ['shape' => 'ServiceUnavailableException',], ['shape' => 'DryRunOperation',], ['shape' => 'UnauthorizedOperation',], ['shape' => 'InvalidInputException',], ['shape' => 'ResourceNotFoundException',],],],
    ], 'shapes' => [
        'AccessDeniedException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true,], 'ApplicationId' => ['type' => 'string', 'max' => 1600, 'min' => 1,], 'ApplicationStatus' => ['type' => 'string', 'enum' => ['NOT_STARTED', 'IN_PROGRESS', 'COMPLETED',],], 'AssociateCreatedArtifactRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName', 'CreatedArtifact',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'CreatedArtifact' => ['shape' => 'CreatedArtifact',], 'DryRun' => ['shape' => 'DryRun',],],], 'AssociateCreatedArtifactResult' => ['type' => 'structure', 'members' => [],], 'AssociateDiscoveredResourceRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName', 'DiscoveredResource',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'DiscoveredResource' => ['shape' => 'DiscoveredResource',], 'DryRun' => ['shape' => 'DryRun',],],], 'AssociateDiscoveredResourceResult' => ['type' => 'structure', 'members' => [],], 'ConfigurationId' => ['type' => 'string', 'min' => 1,], 'CreateProgressUpdateStreamRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStreamName',], 'members' => ['ProgressUpdateStreamName' => ['shape' => 'ProgressUpdateStream',], 'DryRun' => ['shape' => 'DryRun',],],], 'CreateProgressUpdateStreamResult' => ['type' => 'structure', 'members' => [],], 'CreatedArtifact' => ['type' => 'structure', 'required' => ['Name',], 'members' => ['Name' => ['shape' => 'CreatedArtifactName',], 'Description' => ['shape' => 'CreatedArtifactDescription',],],], 'CreatedArtifactDescription' => ['type' => 'string', 'max' => 500, 'min' => 0,], 'CreatedArtifactList' => ['type' => 'list', 'member' => ['shape' => 'CreatedArtifact',],], 'CreatedArtifactName' => ['type' => 'string', 'max' => 1600, 'min' => 1, 'pattern' => 'arn:[a-z-]+:[a-z0-9-]+:(?:[a-z0-9-]+|):(?:[0-9]{12}|):.*',], 'DeleteProgressUpdateStreamRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStreamName',], 'members' => ['ProgressUpdateStreamName' => ['shape' => 'ProgressUpdateStream',], 'DryRun' => ['shape' => 'DryRun',],],], 'DeleteProgressUpdateStreamResult' => ['type' => 'structure', 'members' => [],], 'DescribeApplicationStateRequest' => ['type' => 'structure', 'required' => ['ApplicationId',], 'members' => ['ApplicationId' => ['shape' => 'ApplicationId',],],], 'DescribeApplicationStateResult' => ['type' => 'structure', 'members' => ['ApplicationStatus' => ['shape' => 'ApplicationStatus',], 'LastUpdatedTime' => ['shape' => 'UpdateDateTime',],],], 'DescribeMigrationTaskRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',],],], 'DescribeMigrationTaskResult' => ['type' => 'structure', 'members' => ['MigrationTask' => ['shape' => 'MigrationTask',],],], 'DisassociateCreatedArtifactRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName', 'CreatedArtifactName',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'CreatedArtifactName' => ['shape' => 'CreatedArtifactName',], 'DryRun' => ['shape' => 'DryRun',],],], 'DisassociateCreatedArtifactResult' => ['type' => 'structure', 'members' => [],], 'DisassociateDiscoveredResourceRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName', 'ConfigurationId',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'ConfigurationId' => ['shape' => 'ConfigurationId',], 'DryRun' => ['shape' => 'DryRun',],],], 'DisassociateDiscoveredResourceResult' => ['type' => 'structure', 'members' => [],], 'DiscoveredResource' => ['type' => 'structure', 'required' => ['ConfigurationId',], 'members' => ['ConfigurationId' => ['shape' => 'ConfigurationId',], 'Description' => ['shape' => 'DiscoveredResourceDescription',],],], 'DiscoveredResourceDescription' => ['type' => 'string', 'max' => 500, 'min' => 0,], 'DiscoveredResourceList' => ['type' => 'list', 'member' => ['shape' => 'DiscoveredResource',],], 'DryRun' => ['type' => 'boolean',], 'DryRunOperation' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true,], 'ErrorMessage' => ['type' => 'string',], 'ImportMigrationTaskRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'DryRun' => ['shape' => 'DryRun',],],], 'ImportMigrationTaskResult' => ['type' => 'structure', 'members' => [],], 'InternalServerError' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true, 'fault' => true,], 'InvalidInputException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true,], 'LatestResourceAttributeList' => ['type' => 'list', 'member' => ['shape' => 'ResourceAttribute',], 'max' => 100, 'min' => 0,], 'ListCreatedArtifactsRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'NextToken' => ['shape' => 'Token',], 'MaxResults' => ['shape' => 'MaxResultsCreatedArtifacts',],],], 'ListCreatedArtifactsResult' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token',], 'CreatedArtifactList' => ['shape' => 'CreatedArtifactList',],],], 'ListDiscoveredResourcesRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'NextToken' => ['shape' => 'Token',], 'MaxResults' => ['shape' => 'MaxResultsResources',],],], 'ListDiscoveredResourcesResult' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token',], 'DiscoveredResourceList' => ['shape' => 'DiscoveredResourceList',],],], 'ListMigrationTasksRequest' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token',], 'MaxResults' => ['shape' => 'MaxResults',], 'ResourceName' => ['shape' => 'ResourceName',],],], 'ListMigrationTasksResult' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token',], 'MigrationTaskSummaryList' => ['shape' => 'MigrationTaskSummaryList',],],], 'ListProgressUpdateStreamsRequest' => ['type' => 'structure', 'members' => ['NextToken' => ['shape' => 'Token',], 'MaxResults' => ['shape' => 'MaxResults',],],], 'ListProgressUpdateStreamsResult' => ['type' => 'structure', 'members' => ['ProgressUpdateStreamSummaryList' => ['shape' => 'ProgressUpdateStreamSummaryList',], 'NextToken' => ['shape' => 'Token',],],], 'MaxResults' => ['type' => 'integer', 'box' => true, 'max' => 100, 'min' => 1,], 'MaxResultsCreatedArtifacts' => ['type' => 'integer', 'box' => true, 'max' => 10, 'min' => 1,], 'MaxResultsResources' => ['type' => 'integer', 'box' => true, 'max' => 10, 'min' => 1,], 'MigrationTask' => ['type' => 'structure', 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'Task' => ['shape' => 'Task',], 'UpdateDateTime' => ['shape' => 'UpdateDateTime',], 'ResourceAttributeList' => ['shape' => 'LatestResourceAttributeList',],],], 'MigrationTaskName' => ['type' => 'string', 'max' => 256, 'min' => 1, 'pattern' => '[^:|]+',], 'MigrationTaskSummary' => ['type' => 'structure', 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'Status' => ['shape' => 'Status',], 'ProgressPercent' => ['shape' => 'ProgressPercent',], 'StatusDetail' => ['shape' => 'StatusDetail',], 'UpdateDateTime' => ['shape' => 'UpdateDateTime',],],], 'MigrationTaskSummaryList' => ['type' => 'list', 'member' => ['shape' => 'MigrationTaskSummary',],], 'NextUpdateSeconds' => ['type' => 'integer', 'min' => 0,], 'NotifyApplicationStateRequest' => ['type' => 'structure', 'required' => ['ApplicationId', 'Status',], 'members' => ['ApplicationId' => ['shape' => 'ApplicationId',], 'Status' => ['shape' => 'ApplicationStatus',], 'DryRun' => ['shape' => 'DryRun',],],], 'NotifyApplicationStateResult' => ['type' => 'structure', 'members' => [],], 'NotifyMigrationTaskStateRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName', 'Task', 'UpdateDateTime', 'NextUpdateSeconds',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'Task' => ['shape' => 'Task',], 'UpdateDateTime' => ['shape' => 'UpdateDateTime',], 'NextUpdateSeconds' => ['shape' => 'NextUpdateSeconds',], 'DryRun' => ['shape' => 'DryRun',],],], 'NotifyMigrationTaskStateResult' => ['type' => 'structure', 'members' => [],], 'PolicyErrorException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true,], 'ProgressPercent' => ['type' => 'integer', 'box' => true, 'max' => 100, 'min' => 0,], 'ProgressUpdateStream' => ['type' => 'string', 'max' => 50, 'min' => 1, 'pattern' => '[^/:|\\000-\\037]+',], 'ProgressUpdateStreamSummary' => ['type' => 'structure', 'members' => ['ProgressUpdateStreamName' => ['shape' => 'ProgressUpdateStream',],],], 'ProgressUpdateStreamSummaryList' => ['type' => 'list', 'member' => ['shape' => 'ProgressUpdateStreamSummary',],], 'PutResourceAttributesRequest' => ['type' => 'structure', 'required' => ['ProgressUpdateStream', 'MigrationTaskName', 'ResourceAttributeList',], 'members' => ['ProgressUpdateStream' => ['shape' => 'ProgressUpdateStream',], 'MigrationTaskName' => ['shape' => 'MigrationTaskName',], 'ResourceAttributeList' => ['shape' => 'ResourceAttributeList',], 'DryRun' => ['shape' => 'DryRun',],],], 'PutResourceAttributesResult' => ['type' => 'structure', 'members' => [],], 'ResourceAttribute' => ['type' => 'structure', 'required' => ['Type', 'Value',], 'members' => ['Type' => ['shape' => 'ResourceAttributeType',], 'Value' => ['shape' => 'ResourceAttributeValue',],],], 'ResourceAttributeList' => ['type' => 'list', 'member' => ['shape' => 'ResourceAttribute',], 'max' => 100, 'min' => 1,], 'ResourceAttributeType' => ['type' => 'string', 'enum' => ['IPV4_ADDRESS', 'IPV6_ADDRESS', 'MAC_ADDRESS', 'FQDN', 'VM_MANAGER_ID', 'VM_MANAGED_OBJECT_REFERENCE', 'VM_NAME', 'VM_PATH', 'BIOS_ID', 'MOTHERBOARD_SERIAL_NUMBER',],], 'ResourceAttributeValue' => ['type' => 'string', 'max' => 256, 'min' => 1,], 'ResourceName' => ['type' => 'string', 'max' => 1600, 'min' => 1,], 'ResourceNotFoundException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true,], 'ServiceUnavailableException' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true, 'fault' => true,], 'Status' => ['type' => 'string', 'enum' => ['NOT_STARTED', 'IN_PROGRESS', 'FAILED', 'COMPLETED',],], 'StatusDetail' => ['type' => 'string', 'max' => 500, 'min' => 0,], 'Task' => ['type' => 'structure', 'required' => ['Status',], 'members' => ['Status' => ['shape' => 'Status',], 'StatusDetail' => ['shape' => 'StatusDetail',], 'ProgressPercent' => ['shape' => 'ProgressPercent',],],], 'Token' => ['type' => 'string',], 'UnauthorizedOperation' => ['type' => 'structure', 'members' => ['Message' => ['shape' => 'ErrorMessage',],], 'exception' => true,], 'UpdateDateTime' => ['type' => 'timestamp',],
    ],
];
